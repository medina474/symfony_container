create table job (
    id uuid primary key,
    status text not null,
    payload jsonb not null,
    result jsonb null,
    error_message text null,
    created_at timestamp(0) with time zone default current_timestamp not null,
    completed_at timestamp(0) with time zone default null::timestamp(0) with time zone
);
