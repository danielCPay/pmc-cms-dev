TYPE=VIEW
query=select `e`.`crmid` AS `claimedinvoice`,`e`.`createdtime` AS `createdtime`,`d`.`claimedinvoicesid` AS `claimedinvoicesid`,`d`.`claimed_invoice_name` AS `claimed_invoice_name`,`d`.`number` AS `number`,`d`.`claim` AS `claim`,`d`.`overhead_and_profit` AS `overhead_and_profit`,`d`.`adjusted_invoice_value` AS `adjusted_invoice_value`,`d`.`adjustment` AS `adjustment`,`d`.`prior_collections` AS `prior_collections`,`d`.`invoice_value` AS `invoice_value`,`d`.`invoice_date` AS `invoice_date`,`d`.`special_purchase_price` AS `special_purchase_price`,`d`.`purchase_price` AS `purchase_price`,`d`.`portfolio_purchase` AS `portfolio_purchase`,`d`.`type_of_job` AS `type_of_job`,`d`.`estimate_amount` AS `estimate_amount`,`d`.`types_of_services` AS `types_of_services`,`d`.`dwelling_estimate` AS `dwelling_estimate`,`d`.`other_structures_estimate` AS `other_structures_estimate`,`d`.`personal_property_estimate` AS `personal_property_estimate`,`d`.`loss_of_use_estimate` AS `loss_of_use_estimate` from ((select `yetiforce`.`u_yf_claimedinvoices`.`claimedinvoicesid` AS `claimedinvoicesid`,`yetiforce`.`u_yf_claimedinvoices`.`claimed_invoice_name` AS `claimed_invoice_name`,`yetiforce`.`u_yf_claimedinvoices`.`number` AS `number`,`yetiforce`.`u_yf_claimedinvoices`.`claim` AS `claim`,`yetiforce`.`u_yf_claimedinvoices`.`overhead_and_profit` AS `overhead_and_profit`,`yetiforce`.`u_yf_claimedinvoices`.`adjusted_invoice_value` AS `adjusted_invoice_value`,`yetiforce`.`u_yf_claimedinvoices`.`adjustment` AS `adjustment`,`yetiforce`.`u_yf_claimedinvoices`.`prior_collections` AS `prior_collections`,`yetiforce`.`u_yf_claimedinvoices`.`invoice_value` AS `invoice_value`,`yetiforce`.`u_yf_claimedinvoices`.`invoice_date` AS `invoice_date`,`yetiforce`.`u_yf_claimedinvoices`.`special_purchase_price` AS `special_purchase_price`,`yetiforce`.`u_yf_claimedinvoices`.`purchase_price` AS `purchase_price`,`yetiforce`.`u_yf_claimedinvoices`.`portfolio_purchase` AS `portfolio_purchase`,`yetiforce`.`u_yf_claimedinvoices`.`type_of_job` AS `type_of_job`,`yetiforce`.`u_yf_claimedinvoices`.`estimate_amount` AS `estimate_amount`,`yetiforce`.`u_yf_claimedinvoices`.`types_of_services` AS `types_of_services`,`yetiforce`.`u_yf_claimedinvoices`.`dwelling_estimate` AS `dwelling_estimate`,`yetiforce`.`u_yf_claimedinvoices`.`other_structures_estimate` AS `other_structures_estimate`,`yetiforce`.`u_yf_claimedinvoices`.`personal_property_estimate` AS `personal_property_estimate`,`yetiforce`.`u_yf_claimedinvoices`.`loss_of_use_estimate` AS `loss_of_use_estimate` from (`yetiforce`.`u_yf_claimedinvoices` join `yetiforce`.`u_yf_claimedinvoicescf` on(`yetiforce`.`u_yf_claimedinvoices`.`claimedinvoicesid` = `yetiforce`.`u_yf_claimedinvoicescf`.`claimedinvoicesid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`claimedinvoicesid`)) where `e`.`deleted` = 0
md5=0e5dbaf79874a93f5649636c6bb8f426
updatable=1
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:42
create-version=2
source=SELECT e.crmid AS claimedinvoice, e.createdtime,\n	d.*\nFROM (\n		SELECT *\n		FROM u_yf_claimedinvoices NATURAL JOIN u_yf_claimedinvoicescf\n		) d\n	JOIN vtiger_crmentity e ON ( e.crmid = d.claimedinvoicesid )\nWHERE e.deleted = 0
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `e`.`crmid` AS `claimedinvoice`,`e`.`createdtime` AS `createdtime`,`d`.`claimedinvoicesid` AS `claimedinvoicesid`,`d`.`claimed_invoice_name` AS `claimed_invoice_name`,`d`.`number` AS `number`,`d`.`claim` AS `claim`,`d`.`overhead_and_profit` AS `overhead_and_profit`,`d`.`adjusted_invoice_value` AS `adjusted_invoice_value`,`d`.`adjustment` AS `adjustment`,`d`.`prior_collections` AS `prior_collections`,`d`.`invoice_value` AS `invoice_value`,`d`.`invoice_date` AS `invoice_date`,`d`.`special_purchase_price` AS `special_purchase_price`,`d`.`purchase_price` AS `purchase_price`,`d`.`portfolio_purchase` AS `portfolio_purchase`,`d`.`type_of_job` AS `type_of_job`,`d`.`estimate_amount` AS `estimate_amount`,`d`.`types_of_services` AS `types_of_services`,`d`.`dwelling_estimate` AS `dwelling_estimate`,`d`.`other_structures_estimate` AS `other_structures_estimate`,`d`.`personal_property_estimate` AS `personal_property_estimate`,`d`.`loss_of_use_estimate` AS `loss_of_use_estimate` from ((select `yetiforce`.`u_yf_claimedinvoices`.`claimedinvoicesid` AS `claimedinvoicesid`,`yetiforce`.`u_yf_claimedinvoices`.`claimed_invoice_name` AS `claimed_invoice_name`,`yetiforce`.`u_yf_claimedinvoices`.`number` AS `number`,`yetiforce`.`u_yf_claimedinvoices`.`claim` AS `claim`,`yetiforce`.`u_yf_claimedinvoices`.`overhead_and_profit` AS `overhead_and_profit`,`yetiforce`.`u_yf_claimedinvoices`.`adjusted_invoice_value` AS `adjusted_invoice_value`,`yetiforce`.`u_yf_claimedinvoices`.`adjustment` AS `adjustment`,`yetiforce`.`u_yf_claimedinvoices`.`prior_collections` AS `prior_collections`,`yetiforce`.`u_yf_claimedinvoices`.`invoice_value` AS `invoice_value`,`yetiforce`.`u_yf_claimedinvoices`.`invoice_date` AS `invoice_date`,`yetiforce`.`u_yf_claimedinvoices`.`special_purchase_price` AS `special_purchase_price`,`yetiforce`.`u_yf_claimedinvoices`.`purchase_price` AS `purchase_price`,`yetiforce`.`u_yf_claimedinvoices`.`portfolio_purchase` AS `portfolio_purchase`,`yetiforce`.`u_yf_claimedinvoices`.`type_of_job` AS `type_of_job`,`yetiforce`.`u_yf_claimedinvoices`.`estimate_amount` AS `estimate_amount`,`yetiforce`.`u_yf_claimedinvoices`.`types_of_services` AS `types_of_services`,`yetiforce`.`u_yf_claimedinvoices`.`dwelling_estimate` AS `dwelling_estimate`,`yetiforce`.`u_yf_claimedinvoices`.`other_structures_estimate` AS `other_structures_estimate`,`yetiforce`.`u_yf_claimedinvoices`.`personal_property_estimate` AS `personal_property_estimate`,`yetiforce`.`u_yf_claimedinvoices`.`loss_of_use_estimate` AS `loss_of_use_estimate` from (`yetiforce`.`u_yf_claimedinvoices` join `yetiforce`.`u_yf_claimedinvoicescf` on(`yetiforce`.`u_yf_claimedinvoices`.`claimedinvoicesid` = `yetiforce`.`u_yf_claimedinvoicescf`.`claimedinvoicesid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`claimedinvoicesid`)) where `e`.`deleted` = 0
mariadb-version=100513
