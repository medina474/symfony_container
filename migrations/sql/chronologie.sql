create table chronologie as
  with recursive calendrier as (
    select
      '2023-01-01 00:00:00'::timestamp as jour
    union all
    select
      jour + interval '1 day'
    from calendrier
      where jour + interval '1 day' <= '2027-12-31'
  )
  select
    (extract(epoch from jour) / 86400::int)::int as jj,
    jour,
    extract(year from jour)::int as annee,
    extract(month from jour)::smallint as mois,
    extract(day from jour)::smallint as jmois,
    extract(week from jour)::smallint as semaine,
    extract(dow from jour)::smallint as jsemaine,
    extract(doy from jour)::int as jannee,
    (floor((extract(month from jour) - 1) / 6) + 1)::smallint as semestre,
    (floor((extract(month from jour) - 1) / 4) + 1)::smallint as quadrimestre,
    extract(quarter from jour)::smallint as trimestre,
    (floor((extract(month from jour) - 1) / 2) + 1)::smallint as bimestre,
    (extract (day from jour) / extract (day from (date_trunc('month', '2025-03-16'::date) + interval '1 month' - interval '1 day')))::real  as frac_mois,
    (extract (doy from jour) / extract (doy from (extract (year from jour)||'-12-31')::date))::real  as frac_annee
  from calendrier;

-- migration:statement
comment on column chronologie.jj is 'Jour julien';

-- migration:statement
create view reporting.chronologie as
select
    jj,
    jour,
    annee,
    mois,
    jmois,
    semaine,
    jsemaine,
    jannee,
    semestre,
    quadrimestre,
    trimestre,
    bimestre,
    frac_mois,
    frac_annee
from public.chronologie;
