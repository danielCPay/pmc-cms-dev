TYPE=VIEW
query=select `e`.`crmid` AS `collection`,`e`.`createdtime` AS `createdtime`,`d`.`collectionsid` AS `collectionsid`,`d`.`collection_name` AS `collection_name`,`d`.`number` AS `number`,`d`.`insurance_company` AS `insurance_company`,`d`.`case` AS `case`,`d`.`payment_date` AS `payment_date`,`d`.`deposit_date` AS `deposit_date`,`d`.`disbursed_date` AS `disbursed_date`,`d`.`payment_method` AS `payment_method`,`d`.`collection_type` AS `collection_type`,`d`.`value` AS `value`,`d`.`status_col` AS `status_col`,`d`.`source_bank_account` AS `source_bank_account`,`d`.`destination_bank_account` AS `destination_bank_account`,`d`.`check_number` AS `check_number`,`d`.`date_of_calculations` AS `date_of_calculations`,`d`.`value_to_apply_to_claims` AS `value_to_apply_to_claims`,`d`.`limit_reserve_to_apply_to_clai` AS `limit_reserve_to_apply_to_clai`,`d`.`attorney_fees` AS `attorney_fees`,`d`.`value_plus_attorney_fees` AS `value_plus_attorney_fees`,`d`.`outside_case` AS `outside_case`,`d`.`date_of_disbursal_calculation` AS `date_of_disbursal_calculation` from ((select `yetiforce`.`u_yf_collections`.`collectionsid` AS `collectionsid`,`yetiforce`.`u_yf_collections`.`collection_name` AS `collection_name`,`yetiforce`.`u_yf_collections`.`number` AS `number`,`yetiforce`.`u_yf_collections`.`insurance_company` AS `insurance_company`,`yetiforce`.`u_yf_collections`.`case` AS `case`,`yetiforce`.`u_yf_collections`.`payment_date` AS `payment_date`,`yetiforce`.`u_yf_collections`.`deposit_date` AS `deposit_date`,`yetiforce`.`u_yf_collections`.`disbursed_date` AS `disbursed_date`,`yetiforce`.`u_yf_collections`.`payment_method` AS `payment_method`,`yetiforce`.`u_yf_collections`.`collection_type` AS `collection_type`,`yetiforce`.`u_yf_collections`.`value` AS `value`,`yetiforce`.`u_yf_collections`.`status_col` AS `status_col`,`yetiforce`.`u_yf_collections`.`source_bank_account` AS `source_bank_account`,`yetiforce`.`u_yf_collections`.`destination_bank_account` AS `destination_bank_account`,`yetiforce`.`u_yf_collections`.`check_number` AS `check_number`,`yetiforce`.`u_yf_collections`.`date_of_calculations` AS `date_of_calculations`,`yetiforce`.`u_yf_collections`.`value_to_apply_to_claims` AS `value_to_apply_to_claims`,`yetiforce`.`u_yf_collections`.`limit_reserve_to_apply_to_clai` AS `limit_reserve_to_apply_to_clai`,`yetiforce`.`u_yf_collections`.`attorney_fees` AS `attorney_fees`,`yetiforce`.`u_yf_collections`.`value_plus_attorney_fees` AS `value_plus_attorney_fees`,`yetiforce`.`u_yf_collections`.`outside_case` AS `outside_case`,`yetiforce`.`u_yf_collections`.`date_of_disbursal_calculation` AS `date_of_disbursal_calculation` from (`yetiforce`.`u_yf_collections` join `yetiforce`.`u_yf_collectionscf` on(`yetiforce`.`u_yf_collections`.`collectionsid` = `yetiforce`.`u_yf_collectionscf`.`collectionsid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`collectionsid`)) where `e`.`deleted` = 0
md5=a191086705de7e6dcdbda158a9b95d0f
updatable=1
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:44
create-version=2
source=SELECT e.crmid AS collection, e.createdtime,\n	d.*\nFROM (\n		SELECT *\n		FROM u_yf_collections NATURAL JOIN u_yf_collectionscf\n		) d\n	JOIN vtiger_crmentity e ON ( e.crmid = d.collectionsid )\nWHERE e.deleted = 0
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `e`.`crmid` AS `collection`,`e`.`createdtime` AS `createdtime`,`d`.`collectionsid` AS `collectionsid`,`d`.`collection_name` AS `collection_name`,`d`.`number` AS `number`,`d`.`insurance_company` AS `insurance_company`,`d`.`case` AS `case`,`d`.`payment_date` AS `payment_date`,`d`.`deposit_date` AS `deposit_date`,`d`.`disbursed_date` AS `disbursed_date`,`d`.`payment_method` AS `payment_method`,`d`.`collection_type` AS `collection_type`,`d`.`value` AS `value`,`d`.`status_col` AS `status_col`,`d`.`source_bank_account` AS `source_bank_account`,`d`.`destination_bank_account` AS `destination_bank_account`,`d`.`check_number` AS `check_number`,`d`.`date_of_calculations` AS `date_of_calculations`,`d`.`value_to_apply_to_claims` AS `value_to_apply_to_claims`,`d`.`limit_reserve_to_apply_to_clai` AS `limit_reserve_to_apply_to_clai`,`d`.`attorney_fees` AS `attorney_fees`,`d`.`value_plus_attorney_fees` AS `value_plus_attorney_fees`,`d`.`outside_case` AS `outside_case`,`d`.`date_of_disbursal_calculation` AS `date_of_disbursal_calculation` from ((select `yetiforce`.`u_yf_collections`.`collectionsid` AS `collectionsid`,`yetiforce`.`u_yf_collections`.`collection_name` AS `collection_name`,`yetiforce`.`u_yf_collections`.`number` AS `number`,`yetiforce`.`u_yf_collections`.`insurance_company` AS `insurance_company`,`yetiforce`.`u_yf_collections`.`case` AS `case`,`yetiforce`.`u_yf_collections`.`payment_date` AS `payment_date`,`yetiforce`.`u_yf_collections`.`deposit_date` AS `deposit_date`,`yetiforce`.`u_yf_collections`.`disbursed_date` AS `disbursed_date`,`yetiforce`.`u_yf_collections`.`payment_method` AS `payment_method`,`yetiforce`.`u_yf_collections`.`collection_type` AS `collection_type`,`yetiforce`.`u_yf_collections`.`value` AS `value`,`yetiforce`.`u_yf_collections`.`status_col` AS `status_col`,`yetiforce`.`u_yf_collections`.`source_bank_account` AS `source_bank_account`,`yetiforce`.`u_yf_collections`.`destination_bank_account` AS `destination_bank_account`,`yetiforce`.`u_yf_collections`.`check_number` AS `check_number`,`yetiforce`.`u_yf_collections`.`date_of_calculations` AS `date_of_calculations`,`yetiforce`.`u_yf_collections`.`value_to_apply_to_claims` AS `value_to_apply_to_claims`,`yetiforce`.`u_yf_collections`.`limit_reserve_to_apply_to_clai` AS `limit_reserve_to_apply_to_clai`,`yetiforce`.`u_yf_collections`.`attorney_fees` AS `attorney_fees`,`yetiforce`.`u_yf_collections`.`value_plus_attorney_fees` AS `value_plus_attorney_fees`,`yetiforce`.`u_yf_collections`.`outside_case` AS `outside_case`,`yetiforce`.`u_yf_collections`.`date_of_disbursal_calculation` AS `date_of_disbursal_calculation` from (`yetiforce`.`u_yf_collections` join `yetiforce`.`u_yf_collectionscf` on(`yetiforce`.`u_yf_collections`.`collectionsid` = `yetiforce`.`u_yf_collectionscf`.`collectionsid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`collectionsid`)) where `e`.`deleted` = 0
mariadb-version=100513
