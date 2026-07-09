-- Extensions
-- ----------------------------------------------------------------------------
-- Le module pg_trgm fournit des fonctions et des opérateurs pour déterminer la  
-- similitude du texte alphanumérique ASCII basé sur la correspondance de 
-- trigramme, ainsi que des classes d'opérateurs d'index qui prennent en charge  
-- la recherche rapide de chaînes similaires.
create extension if not exists pg_trgm;

-- Symfony
-- ----------------------------------------------------------------------------

-- ----------------------------------------------------------------------------
create table job (
    id uuid primary key,
    status text not null,
    payload jsonb not null,
    result jsonb null,
    error_message text null,
    created_at timestamp(0) with time zone default current_timestamp not null,
    completed_at timestamp(0) with time zone default null::timestamp(0) with time zone
);

-- ----------------------------------------------------------------------------
create table tncc (
    id smallint primary key,
    article text,
    charniere text
);

insert into tncc values
(0, '', 'de '),
(1, '', 'd'''),
(2, 'le ', 'du '),
(3, 'la ', 'de la '),
(4, 'les ', 'des '),
(5, 'l''', 'de l'''),
(6, 'aux ', 'des '),
(7, 'las ', 'de las '),
(8, 'los ', 'de los ');

-- Pays

create table country
(
    code text primary key,
    country text not null,
    tncc_id smallint references tncc,
    flag text,
    "long" text, -- noqa: RF06
    intracommunity boolean not null default false,
    sepa boolean not null default false,
    phonecode smallint
);

-- Index pour la pagination
create index concurrently idx_country_country_code
on country (country, code);

-- Colonne pour la recherche textuelle
alter table country
add column _country text;

-- Mise à jour de cette colonne 
create or replace function country_search_text_trigger()
returns trigger
language plpgsql
as $$
begin
  new._country := concat(norm(new.country), ' ', norm(new.long));
  return new;
end;
$$;

create trigger trg_country_search_text
before insert or update of country
on country
for each row
execute function country_search_text_trigger();

create index concurrently idx_country_search
on country
using gin (_country gin_trgm_ops);
-- ----------------------------------------------------------------------------
