TYPE=VIEW
query=select `e`.`crmid` AS `insured`,`e`.`createdtime` AS `createdtime`,`d`.`insuredsid` AS `insuredsid`,`d`.`insured_name` AS `insured_name`,`d`.`number` AS `number`,`d`.`insured1_first_name` AS `insured1_first_name`,`d`.`insured1_last_name` AS `insured1_last_name`,`d`.`insured2_first_name` AS `insured2_first_name`,`d`.`insured2_last_name` AS `insured2_last_name`,`d`.`insured3_first_name` AS `insured3_first_name`,`d`.`insured3_last_name` AS `insured3_last_name`,`d`.`insured4_first_name` AS `insured4_first_name`,`d`.`insured4_last_name` AS `insured4_last_name`,`d`.`street` AS `street`,`d`.`www` AS `www`,`d`.`build_name_automatically` AS `build_name_automatically`,`d`.`county` AS `county`,`d`.`zip` AS `zip`,`d`.`city` AS `city`,`d`.`e_mail` AS `e_mail`,`d`.`phone` AS `phone`,`d`.`phone_extra` AS `phone_extra`,`d`.`state` AS `state` from ((select `yetiforce`.`u_yf_insureds`.`insuredsid` AS `insuredsid`,`yetiforce`.`u_yf_insureds`.`insured_name` AS `insured_name`,`yetiforce`.`u_yf_insureds`.`number` AS `number`,`yetiforce`.`u_yf_insureds`.`insured1_first_name` AS `insured1_first_name`,`yetiforce`.`u_yf_insureds`.`insured1_last_name` AS `insured1_last_name`,`yetiforce`.`u_yf_insureds`.`insured2_first_name` AS `insured2_first_name`,`yetiforce`.`u_yf_insureds`.`insured2_last_name` AS `insured2_last_name`,`yetiforce`.`u_yf_insureds`.`insured3_first_name` AS `insured3_first_name`,`yetiforce`.`u_yf_insureds`.`insured3_last_name` AS `insured3_last_name`,`yetiforce`.`u_yf_insureds`.`insured4_first_name` AS `insured4_first_name`,`yetiforce`.`u_yf_insureds`.`insured4_last_name` AS `insured4_last_name`,`yetiforce`.`u_yf_insureds`.`street` AS `street`,`yetiforce`.`u_yf_insureds`.`www` AS `www`,`yetiforce`.`u_yf_insureds`.`build_name_automatically` AS `build_name_automatically`,`yetiforce`.`u_yf_insureds`.`county` AS `county`,`yetiforce`.`u_yf_insuredscf`.`zip` AS `zip`,`yetiforce`.`u_yf_insuredscf`.`city` AS `city`,`yetiforce`.`u_yf_insuredscf`.`e_mail` AS `e_mail`,`yetiforce`.`u_yf_insuredscf`.`phone` AS `phone`,`yetiforce`.`u_yf_insuredscf`.`phone_extra` AS `phone_extra`,`yetiforce`.`u_yf_insuredscf`.`state` AS `state` from (`yetiforce`.`u_yf_insureds` join `yetiforce`.`u_yf_insuredscf` on(`yetiforce`.`u_yf_insureds`.`insuredsid` = `yetiforce`.`u_yf_insuredscf`.`insuredsid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`insuredsid`)) where `e`.`deleted` = 0
md5=b2a384a88490866c9334cc3c6675bcf4
updatable=1
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:43
create-version=2
source=SELECT e.crmid AS insured, e.createdtime,
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `e`.`crmid` AS `insured`,`e`.`createdtime` AS `createdtime`,`d`.`insuredsid` AS `insuredsid`,`d`.`insured_name` AS `insured_name`,`d`.`number` AS `number`,`d`.`insured1_first_name` AS `insured1_first_name`,`d`.`insured1_last_name` AS `insured1_last_name`,`d`.`insured2_first_name` AS `insured2_first_name`,`d`.`insured2_last_name` AS `insured2_last_name`,`d`.`insured3_first_name` AS `insured3_first_name`,`d`.`insured3_last_name` AS `insured3_last_name`,`d`.`insured4_first_name` AS `insured4_first_name`,`d`.`insured4_last_name` AS `insured4_last_name`,`d`.`street` AS `street`,`d`.`www` AS `www`,`d`.`build_name_automatically` AS `build_name_automatically`,`d`.`county` AS `county`,`d`.`zip` AS `zip`,`d`.`city` AS `city`,`d`.`e_mail` AS `e_mail`,`d`.`phone` AS `phone`,`d`.`phone_extra` AS `phone_extra`,`d`.`state` AS `state` from ((select `yetiforce`.`u_yf_insureds`.`insuredsid` AS `insuredsid`,`yetiforce`.`u_yf_insureds`.`insured_name` AS `insured_name`,`yetiforce`.`u_yf_insureds`.`number` AS `number`,`yetiforce`.`u_yf_insureds`.`insured1_first_name` AS `insured1_first_name`,`yetiforce`.`u_yf_insureds`.`insured1_last_name` AS `insured1_last_name`,`yetiforce`.`u_yf_insureds`.`insured2_first_name` AS `insured2_first_name`,`yetiforce`.`u_yf_insureds`.`insured2_last_name` AS `insured2_last_name`,`yetiforce`.`u_yf_insureds`.`insured3_first_name` AS `insured3_first_name`,`yetiforce`.`u_yf_insureds`.`insured3_last_name` AS `insured3_last_name`,`yetiforce`.`u_yf_insureds`.`insured4_first_name` AS `insured4_first_name`,`yetiforce`.`u_yf_insureds`.`insured4_last_name` AS `insured4_last_name`,`yetiforce`.`u_yf_insureds`.`street` AS `street`,`yetiforce`.`u_yf_insureds`.`www` AS `www`,`yetiforce`.`u_yf_insureds`.`build_name_automatically` AS `build_name_automatically`,`yetiforce`.`u_yf_insureds`.`county` AS `county`,`yetiforce`.`u_yf_insuredscf`.`zip` AS `zip`,`yetiforce`.`u_yf_insuredscf`.`city` AS `city`,`yetiforce`.`u_yf_insuredscf`.`e_mail` AS `e_mail`,`yetiforce`.`u_yf_insuredscf`.`phone` AS `phone`,`yetiforce`.`u_yf_insuredscf`.`phone_extra` AS `phone_extra`,`yetiforce`.`u_yf_insuredscf`.`state` AS `state` from (`yetiforce`.`u_yf_insureds` join `yetiforce`.`u_yf_insuredscf` on(`yetiforce`.`u_yf_insureds`.`insuredsid` = `yetiforce`.`u_yf_insuredscf`.`insuredsid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`insuredsid`)) where `e`.`deleted` = 0
mariadb-version=100513