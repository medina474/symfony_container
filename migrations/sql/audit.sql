create table audit (
    id bigint primary key generated always as identity,
    created_at timestamptz default current_timestamp not null,
    "action" varchar(50) not null,
    user_id bigint,
    entity varchar(50) null,
    entity_id bigint null,
    ip_address inet null,
    user_agent text null,
    trace_id char(32),
    span_id char(16),
    message text,
    "data" jsonb
);

-- migration:statement
create view reporting.audit as
select
    id,
    created_at,
    action
from public.audit;
