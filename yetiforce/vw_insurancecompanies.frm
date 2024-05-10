TYPE=VIEW
query=select `e`.`crmid` AS `insurance_company`,`e`.`createdtime` AS `createdtime`,`d`.`insurancecompaniesid` AS `insurancecompaniesid`,`d`.`insurance_company_name` AS `insurance_company_name`,`d`.`number` AS `number`,`d`.`force_place_carrier` AS `force_place_carrier`,`d`.`in_good_standing` AS `in_good_standing`,`d`.`street` AS `street`,`d`.`zip` AS `zip`,`d`.`city` AS `city`,`d`.`state` AS `state`,`d`.`email` AS `email`,`d`.`email_for_voluntary_collection` AS `email_for_voluntary_collection`,`d`.`email_for_litigation` AS `email_for_litigation`,`d`.`www` AS `www`,`d`.`phone` AS `phone`,`d`.`phone_extra` AS `phone_extra` from ((select `yetiforce`.`u_yf_insurancecompanies`.`insurancecompaniesid` AS `insurancecompaniesid`,`yetiforce`.`u_yf_insurancecompanies`.`insurance_company_name` AS `insurance_company_name`,`yetiforce`.`u_yf_insurancecompanies`.`number` AS `number`,`yetiforce`.`u_yf_insurancecompanies`.`force_place_carrier` AS `force_place_carrier`,`yetiforce`.`u_yf_insurancecompanies`.`in_good_standing` AS `in_good_standing`,`yetiforce`.`u_yf_insurancecompanies`.`street` AS `street`,`yetiforce`.`u_yf_insurancecompanies`.`zip` AS `zip`,`yetiforce`.`u_yf_insurancecompanies`.`city` AS `city`,`yetiforce`.`u_yf_insurancecompanies`.`state` AS `state`,`yetiforce`.`u_yf_insurancecompanies`.`email` AS `email`,`yetiforce`.`u_yf_insurancecompanies`.`email_for_voluntary_collection` AS `email_for_voluntary_collection`,`yetiforce`.`u_yf_insurancecompanies`.`email_for_litigation` AS `email_for_litigation`,`yetiforce`.`u_yf_insurancecompanies`.`www` AS `www`,`yetiforce`.`u_yf_insurancecompanies`.`phone` AS `phone`,`yetiforce`.`u_yf_insurancecompanies`.`phone_extra` AS `phone_extra` from (`yetiforce`.`u_yf_insurancecompanies` join `yetiforce`.`u_yf_insurancecompaniescf` on(`yetiforce`.`u_yf_insurancecompanies`.`insurancecompaniesid` = `yetiforce`.`u_yf_insurancecompaniescf`.`insurancecompaniesid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`insurancecompaniesid`)) where `e`.`deleted` = 0
md5=b6d311badccbb05832bd4c21344e6fac
updatable=1
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:43
create-version=2
source=SELECT e.crmid AS insurance_company, e.createdtime,
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `e`.`crmid` AS `insurance_company`,`e`.`createdtime` AS `createdtime`,`d`.`insurancecompaniesid` AS `insurancecompaniesid`,`d`.`insurance_company_name` AS `insurance_company_name`,`d`.`number` AS `number`,`d`.`force_place_carrier` AS `force_place_carrier`,`d`.`in_good_standing` AS `in_good_standing`,`d`.`street` AS `street`,`d`.`zip` AS `zip`,`d`.`city` AS `city`,`d`.`state` AS `state`,`d`.`email` AS `email`,`d`.`email_for_voluntary_collection` AS `email_for_voluntary_collection`,`d`.`email_for_litigation` AS `email_for_litigation`,`d`.`www` AS `www`,`d`.`phone` AS `phone`,`d`.`phone_extra` AS `phone_extra` from ((select `yetiforce`.`u_yf_insurancecompanies`.`insurancecompaniesid` AS `insurancecompaniesid`,`yetiforce`.`u_yf_insurancecompanies`.`insurance_company_name` AS `insurance_company_name`,`yetiforce`.`u_yf_insurancecompanies`.`number` AS `number`,`yetiforce`.`u_yf_insurancecompanies`.`force_place_carrier` AS `force_place_carrier`,`yetiforce`.`u_yf_insurancecompanies`.`in_good_standing` AS `in_good_standing`,`yetiforce`.`u_yf_insurancecompanies`.`street` AS `street`,`yetiforce`.`u_yf_insurancecompanies`.`zip` AS `zip`,`yetiforce`.`u_yf_insurancecompanies`.`city` AS `city`,`yetiforce`.`u_yf_insurancecompanies`.`state` AS `state`,`yetiforce`.`u_yf_insurancecompanies`.`email` AS `email`,`yetiforce`.`u_yf_insurancecompanies`.`email_for_voluntary_collection` AS `email_for_voluntary_collection`,`yetiforce`.`u_yf_insurancecompanies`.`email_for_litigation` AS `email_for_litigation`,`yetiforce`.`u_yf_insurancecompanies`.`www` AS `www`,`yetiforce`.`u_yf_insurancecompanies`.`phone` AS `phone`,`yetiforce`.`u_yf_insurancecompanies`.`phone_extra` AS `phone_extra` from (`yetiforce`.`u_yf_insurancecompanies` join `yetiforce`.`u_yf_insurancecompaniescf` on(`yetiforce`.`u_yf_insurancecompanies`.`insurancecompaniesid` = `yetiforce`.`u_yf_insurancecompaniescf`.`insurancecompaniesid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`insurancecompaniesid`)) where `e`.`deleted` = 0
mariadb-version=100513