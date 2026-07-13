create table job (
    id uuid primary key,
    "action" text not null, -- noqa: RF06
    status text not null,
    payload jsonb not null,
    result jsonb null,
    error_message text null,
    retry_count smallint not null default 0,
    created_at timestamp(0) with time zone default current_timestamp not null,
    handled_at timestamp(0) with time zone default null::timestamp(0) with time zone,
    completed_at timestamp(0) with time zone default null::timestamp(0) with time zone
);

-- migration:statement
create view reporting.job as
select
    id,
    action,
    status,
    payload,
    result,
    error_message,
    retry_count,
    created_at,
    handled_at,
    completed_at
from public.job;
