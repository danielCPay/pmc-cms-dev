TYPE=VIEW
query=select `e`.`crmid` AS `portfolio`,`e`.`createdtime` AS `createdtime`,`d`.`portfoliosid` AS `portfoliosid`,`d`.`portfolio_id` AS `portfolio_id`,`d`.`number` AS `number`,`d`.`provider` AS `provider`,`d`.`portfolio_status` AS `portfolio_status`,`d`.`program` AS `program`,`d`.`created_date` AS `created_date`,`d`.`proposal_underwriter` AS `proposal_underwriter`,`d`.`total_number_of_claims` AS `total_number_of_claims`,`d`.`total_claim_value` AS `total_claim_value`,`d`.`adjusted_claim_value` AS `adjusted_claim_value`,`d`.`total_number_accepted_claims` AS `total_number_accepted_claims`,`d`.`total_value_accepted_claims` AS `total_value_accepted_claims`,`d`.`total_adjusted_face_value` AS `total_adjusted_face_value`,`d`.`total_purchase_price` AS `total_purchase_price`,`d`.`total_voluntary_collections` AS `total_voluntary_collections`,`d`.`total_presuit_collections` AS `total_presuit_collections`,`d`.`total_litigated_collections` AS `total_litigated_collections`,`d`.`total_buybacks` AS `total_buybacks`,`d`.`total_profit` AS `total_profit`,`d`.`total_reserves_to_be_released` AS `total_reserves_to_be_released`,`d`.`note` AS `note`,`d`.`investor` AS `investor`,`d`.`approved_date` AS `approved_date`,`d`.`opened_date` AS `opened_date`,`d`.`closed_date` AS `closed_date`,`d`.`total_number_of_aob_claims` AS `total_number_of_aob_claims`,`d`.`total_num_of_rejected_claims` AS `total_num_of_rejected_claims`,`d`.`total_value_of_rejected_claims` AS `total_value_of_rejected_claims`,`d`.`total_reserves_released` AS `total_reserves_released`,`d`.`last_reserves_released_date` AS `last_reserves_released_date`,`d`.`lock_automation` AS `lock_automation`,`d`.`total_reserves` AS `total_reserves`,`d`.`total_limit_reserve` AS `total_limit_reserve`,`d`.`refundable_reserve` AS `refundable_reserve`,`d`.`portfolio_write_off` AS `portfolio_write_off`,`d`.`remaining_to_hurdle` AS `remaining_to_hurdle`,`d`.`total_balance_owed` AS `total_balance_owed`,`d`.`total_collections` AS `total_collections`,`d`.`portfolio_approver_name` AS `portfolio_approver_name`,`d`.`total_number_of_paid_claims` AS `total_number_of_paid_claims`,`d`.`total_factor_fee` AS `total_factor_fee`,`d`.`hurdle` AS `hurdle`,`d`.`hurdle_percent` AS `hurdle_percent`,`d`.`total_number_of_buybacks` AS `total_number_of_buybacks` from ((select `yetiforce`.`u_yf_portfolios`.`portfoliosid` AS `portfoliosid`,`yetiforce`.`u_yf_portfolios`.`portfolio_id` AS `portfolio_id`,`yetiforce`.`u_yf_portfolios`.`number` AS `number`,`yetiforce`.`u_yf_portfolios`.`provider` AS `provider`,`yetiforce`.`u_yf_portfolios`.`portfolio_status` AS `portfolio_status`,`yetiforce`.`u_yf_portfolios`.`program` AS `program`,`yetiforce`.`u_yf_portfolios`.`created_date` AS `created_date`,`yetiforce`.`u_yf_portfolios`.`proposal_underwriter` AS `proposal_underwriter`,`yetiforce`.`u_yf_portfolios`.`total_number_of_claims` AS `total_number_of_claims`,`yetiforce`.`u_yf_portfolios`.`total_claim_value` AS `total_claim_value`,`yetiforce`.`u_yf_portfolios`.`adjusted_claim_value` AS `adjusted_claim_value`,`yetiforce`.`u_yf_portfolios`.`total_number_accepted_claims` AS `total_number_accepted_claims`,`yetiforce`.`u_yf_portfolios`.`total_value_accepted_claims` AS `total_value_accepted_claims`,`yetiforce`.`u_yf_portfolios`.`total_adjusted_face_value` AS `total_adjusted_face_value`,`yetiforce`.`u_yf_portfolios`.`total_purchase_price` AS `total_purchase_price`,`yetiforce`.`u_yf_portfolios`.`total_voluntary_collections` AS `total_voluntary_collections`,`yetiforce`.`u_yf_portfolios`.`total_presuit_collections` AS `total_presuit_collections`,`yetiforce`.`u_yf_portfolios`.`total_litigated_collections` AS `total_litigated_collections`,`yetiforce`.`u_yf_portfolios`.`total_buybacks` AS `total_buybacks`,`yetiforce`.`u_yf_portfolios`.`total_profit` AS `total_profit`,`yetiforce`.`u_yf_portfolios`.`total_reserves_to_be_released` AS `total_reserves_to_be_released`,`yetiforce`.`u_yf_portfolios`.`note` AS `note`,`yetiforce`.`u_yf_portfolios`.`investor` AS `investor`,`yetiforce`.`u_yf_portfolios`.`approved_date` AS `approved_date`,`yetiforce`.`u_yf_portfolios`.`opened_date` AS `opened_date`,`yetiforce`.`u_yf_portfolios`.`closed_date` AS `closed_date`,`yetiforce`.`u_yf_portfolios`.`total_number_of_aob_claims` AS `total_number_of_aob_claims`,`yetiforce`.`u_yf_portfolios`.`total_num_of_rejected_claims` AS `total_num_of_rejected_claims`,`yetiforce`.`u_yf_portfolios`.`total_value_of_rejected_claims` AS `total_value_of_rejected_claims`,`yetiforce`.`u_yf_portfolios`.`total_reserves_released` AS `total_reserves_released`,`yetiforce`.`u_yf_portfolios`.`last_reserves_released_date` AS `last_reserves_released_date`,`yetiforce`.`u_yf_portfolios`.`lock_automation` AS `lock_automation`,`yetiforce`.`u_yf_portfolios`.`total_reserves` AS `total_reserves`,`yetiforce`.`u_yf_portfolios`.`total_limit_reserve` AS `total_limit_reserve`,`yetiforce`.`u_yf_portfolios`.`refundable_reserve` AS `refundable_reserve`,`yetiforce`.`u_yf_portfolios`.`portfolio_write_off` AS `portfolio_write_off`,`yetiforce`.`u_yf_portfolios`.`remaining_to_hurdle` AS `remaining_to_hurdle`,`yetiforce`.`u_yf_portfolios`.`total_balance_owed` AS `total_balance_owed`,`yetiforce`.`u_yf_portfolios`.`total_collections` AS `total_collections`,`yetiforce`.`u_yf_portfolios`.`portfolio_approver_name` AS `portfolio_approver_name`,`yetiforce`.`u_yf_portfolios`.`total_number_of_paid_claims` AS `total_number_of_paid_claims`,`yetiforce`.`u_yf_portfolios`.`total_factor_fee` AS `total_factor_fee`,`yetiforce`.`u_yf_portfolios`.`hurdle` AS `hurdle`,`yetiforce`.`u_yf_portfolios`.`hurdle_percent` AS `hurdle_percent`,`yetiforce`.`u_yf_portfolios`.`total_number_of_buybacks` AS `total_number_of_buybacks` from (`yetiforce`.`u_yf_portfolios` join `yetiforce`.`u_yf_portfolioscf` on(`yetiforce`.`u_yf_portfolios`.`portfoliosid` = `yetiforce`.`u_yf_portfolioscf`.`portfoliosid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`portfoliosid`)) where `e`.`deleted` = 0
md5=ff31d5d077f50b78d98c450f07801f4e
updatable=1
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:42
create-version=2
source=SELECT e.crmid AS portfolio, e.createdtime,
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select `e`.`crmid` AS `portfolio`,`e`.`createdtime` AS `createdtime`,`d`.`portfoliosid` AS `portfoliosid`,`d`.`portfolio_id` AS `portfolio_id`,`d`.`number` AS `number`,`d`.`provider` AS `provider`,`d`.`portfolio_status` AS `portfolio_status`,`d`.`program` AS `program`,`d`.`created_date` AS `created_date`,`d`.`proposal_underwriter` AS `proposal_underwriter`,`d`.`total_number_of_claims` AS `total_number_of_claims`,`d`.`total_claim_value` AS `total_claim_value`,`d`.`adjusted_claim_value` AS `adjusted_claim_value`,`d`.`total_number_accepted_claims` AS `total_number_accepted_claims`,`d`.`total_value_accepted_claims` AS `total_value_accepted_claims`,`d`.`total_adjusted_face_value` AS `total_adjusted_face_value`,`d`.`total_purchase_price` AS `total_purchase_price`,`d`.`total_voluntary_collections` AS `total_voluntary_collections`,`d`.`total_presuit_collections` AS `total_presuit_collections`,`d`.`total_litigated_collections` AS `total_litigated_collections`,`d`.`total_buybacks` AS `total_buybacks`,`d`.`total_profit` AS `total_profit`,`d`.`total_reserves_to_be_released` AS `total_reserves_to_be_released`,`d`.`note` AS `note`,`d`.`investor` AS `investor`,`d`.`approved_date` AS `approved_date`,`d`.`opened_date` AS `opened_date`,`d`.`closed_date` AS `closed_date`,`d`.`total_number_of_aob_claims` AS `total_number_of_aob_claims`,`d`.`total_num_of_rejected_claims` AS `total_num_of_rejected_claims`,`d`.`total_value_of_rejected_claims` AS `total_value_of_rejected_claims`,`d`.`total_reserves_released` AS `total_reserves_released`,`d`.`last_reserves_released_date` AS `last_reserves_released_date`,`d`.`lock_automation` AS `lock_automation`,`d`.`total_reserves` AS `total_reserves`,`d`.`total_limit_reserve` AS `total_limit_reserve`,`d`.`refundable_reserve` AS `refundable_reserve`,`d`.`portfolio_write_off` AS `portfolio_write_off`,`d`.`remaining_to_hurdle` AS `remaining_to_hurdle`,`d`.`total_balance_owed` AS `total_balance_owed`,`d`.`total_collections` AS `total_collections`,`d`.`portfolio_approver_name` AS `portfolio_approver_name`,`d`.`total_number_of_paid_claims` AS `total_number_of_paid_claims`,`d`.`total_factor_fee` AS `total_factor_fee`,`d`.`hurdle` AS `hurdle`,`d`.`hurdle_percent` AS `hurdle_percent`,`d`.`total_number_of_buybacks` AS `total_number_of_buybacks` from ((select `yetiforce`.`u_yf_portfolios`.`portfoliosid` AS `portfoliosid`,`yetiforce`.`u_yf_portfolios`.`portfolio_id` AS `portfolio_id`,`yetiforce`.`u_yf_portfolios`.`number` AS `number`,`yetiforce`.`u_yf_portfolios`.`provider` AS `provider`,`yetiforce`.`u_yf_portfolios`.`portfolio_status` AS `portfolio_status`,`yetiforce`.`u_yf_portfolios`.`program` AS `program`,`yetiforce`.`u_yf_portfolios`.`created_date` AS `created_date`,`yetiforce`.`u_yf_portfolios`.`proposal_underwriter` AS `proposal_underwriter`,`yetiforce`.`u_yf_portfolios`.`total_number_of_claims` AS `total_number_of_claims`,`yetiforce`.`u_yf_portfolios`.`total_claim_value` AS `total_claim_value`,`yetiforce`.`u_yf_portfolios`.`adjusted_claim_value` AS `adjusted_claim_value`,`yetiforce`.`u_yf_portfolios`.`total_number_accepted_claims` AS `total_number_accepted_claims`,`yetiforce`.`u_yf_portfolios`.`total_value_accepted_claims` AS `total_value_accepted_claims`,`yetiforce`.`u_yf_portfolios`.`total_adjusted_face_value` AS `total_adjusted_face_value`,`yetiforce`.`u_yf_portfolios`.`total_purchase_price` AS `total_purchase_price`,`yetiforce`.`u_yf_portfolios`.`total_voluntary_collections` AS `total_voluntary_collections`,`yetiforce`.`u_yf_portfolios`.`total_presuit_collections` AS `total_presuit_collections`,`yetiforce`.`u_yf_portfolios`.`total_litigated_collections` AS `total_litigated_collections`,`yetiforce`.`u_yf_portfolios`.`total_buybacks` AS `total_buybacks`,`yetiforce`.`u_yf_portfolios`.`total_profit` AS `total_profit`,`yetiforce`.`u_yf_portfolios`.`total_reserves_to_be_released` AS `total_reserves_to_be_released`,`yetiforce`.`u_yf_portfolios`.`note` AS `note`,`yetiforce`.`u_yf_portfolios`.`investor` AS `investor`,`yetiforce`.`u_yf_portfolios`.`approved_date` AS `approved_date`,`yetiforce`.`u_yf_portfolios`.`opened_date` AS `opened_date`,`yetiforce`.`u_yf_portfolios`.`closed_date` AS `closed_date`,`yetiforce`.`u_yf_portfolios`.`total_number_of_aob_claims` AS `total_number_of_aob_claims`,`yetiforce`.`u_yf_portfolios`.`total_num_of_rejected_claims` AS `total_num_of_rejected_claims`,`yetiforce`.`u_yf_portfolios`.`total_value_of_rejected_claims` AS `total_value_of_rejected_claims`,`yetiforce`.`u_yf_portfolios`.`total_reserves_released` AS `total_reserves_released`,`yetiforce`.`u_yf_portfolios`.`last_reserves_released_date` AS `last_reserves_released_date`,`yetiforce`.`u_yf_portfolios`.`lock_automation` AS `lock_automation`,`yetiforce`.`u_yf_portfolios`.`total_reserves` AS `total_reserves`,`yetiforce`.`u_yf_portfolios`.`total_limit_reserve` AS `total_limit_reserve`,`yetiforce`.`u_yf_portfolios`.`refundable_reserve` AS `refundable_reserve`,`yetiforce`.`u_yf_portfolios`.`portfolio_write_off` AS `portfolio_write_off`,`yetiforce`.`u_yf_portfolios`.`remaining_to_hurdle` AS `remaining_to_hurdle`,`yetiforce`.`u_yf_portfolios`.`total_balance_owed` AS `total_balance_owed`,`yetiforce`.`u_yf_portfolios`.`total_collections` AS `total_collections`,`yetiforce`.`u_yf_portfolios`.`portfolio_approver_name` AS `portfolio_approver_name`,`yetiforce`.`u_yf_portfolios`.`total_number_of_paid_claims` AS `total_number_of_paid_claims`,`yetiforce`.`u_yf_portfolios`.`total_factor_fee` AS `total_factor_fee`,`yetiforce`.`u_yf_portfolios`.`hurdle` AS `hurdle`,`yetiforce`.`u_yf_portfolios`.`hurdle_percent` AS `hurdle_percent`,`yetiforce`.`u_yf_portfolios`.`total_number_of_buybacks` AS `total_number_of_buybacks` from (`yetiforce`.`u_yf_portfolios` join `yetiforce`.`u_yf_portfolioscf` on(`yetiforce`.`u_yf_portfolios`.`portfoliosid` = `yetiforce`.`u_yf_portfolioscf`.`portfoliosid`))) `d` join `yetiforce`.`vtiger_crmentity` `e` on(`e`.`crmid` = `d`.`portfoliosid`)) where `e`.`deleted` = 0
mariadb-version=100513