create temporary table pays_import
(
    code2 text,
    code3 text,
    code_num text,
    pays text,
    tncc smallint,
    drapeau_unicode text,
    forme_longue text,
    independant boolean,
    communautaire boolean,
    sepa boolean,
    telephone smallint
);

copy pays_import
from '/data/app/geo/pays.csv' (format csv, header);

insert into country
select
    code2,
    pays,
    tncc,
    drapeau_unicode,
    forme_longue,
    communautaire,
    sepa,
    telephone
from pays_import
where independant is true;
