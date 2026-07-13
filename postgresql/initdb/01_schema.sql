-- Reporting
-- ----------------------------------------------------------------------------
create schema reporting;

create role grafana noinherit login password '9410';

grant connect on database app to grafana;

alter role grafana in database app set search_path = reporting;
grant usage on schema reporting to grafana;

alter default privileges in schema reporting
grant select on tables to grafana;
