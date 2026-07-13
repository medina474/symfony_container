create schema if not exists reporting;

-- migration:statement
create role grafana noinherit login password '9410';

-- migration:statement
grant connect on database app to grafana;

-- migration:statement
alter role grafana in database app set search_path = reporting;

-- migration:statement
grant usage on schema reporting to grafana;

-- migration:statement
alter default privileges in schema reporting

-- migration:statement
grant select on tables to grafana;
