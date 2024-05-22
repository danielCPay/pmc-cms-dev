TYPE=VIEW
query=select `yetiforce`.`vtiger_users`.`id` AS `user_id`,`yetiforce`.`vtiger_users`.`first_name` AS `first_name`,`yetiforce`.`vtiger_users`.`last_name` AS `last_name`,concat(`yetiforce`.`vtiger_users`.`first_name`,\' \',`yetiforce`.`vtiger_users`.`last_name`) AS `user_full_name` from `yetiforce`.`vtiger_users`
md5=a8b226cee851868a164ebf60c1177cd4
updatable=1
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:44
create-version=2
source=SELECT id AS user_id, first_name, last_name, CONCAT(first_name, \' \', last_name) AS user_full_name\nFROM vtiger_users
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `yetiforce`.`vtiger_users`.`id` AS `user_id`,`yetiforce`.`vtiger_users`.`first_name` AS `first_name`,`yetiforce`.`vtiger_users`.`last_name` AS `last_name`,concat(`yetiforce`.`vtiger_users`.`first_name`,\' \',`yetiforce`.`vtiger_users`.`last_name`) AS `user_full_name` from `yetiforce`.`vtiger_users`
mariadb-version=100513
