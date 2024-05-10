TYPE=VIEW
query=select \'Onboarding Status\' AS `status_area`,`vw_claims`.`onboarding_status` AS `status_value`,count(0) AS `number_of_elements` from `yetiforce`.`vw_claims` group by `vw_claims`.`onboarding_status` union all select \'Claim Status\' AS `Claim Status`,`vw_claims`.`claim_status` AS `claim_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_claims` group by `vw_claims`.`claim_status` union all select \'Provider Status\' AS `Provider Status`,`vw_providers`.`provider_status` AS `provider_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_providers` group by `vw_providers`.`provider_status` union all select \'Portfolio Status\' AS `Portfolio Status`,`vw_portfolios`.`portfolio_status` AS `portfolio_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolios` group by `vw_portfolios`.`portfolio_status` union all select \'Portfolio Purchase Status\' AS `Portfolio Purchase Status`,`vw_portfolio_purchases`.`portfolio_purchase_status` AS `portfolio_purchase_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolio_purchases` group by `vw_portfolio_purchases`.`portfolio_purchase_status` union all select \'Portfolio Purchases\' AS `Portfolio Purchases`,\'Sent for Signature\' AS `Sent for Signature`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolio_purchases` where cast(`vw_portfolio_purchases`.`sent_be_signed_date` as date) = cast(curdate() + interval -1 day as date) union all select \'Portfolio Purchases\' AS `Portfolio Purchases`,\'Signed/Purchased\' AS `Signed/Purchased`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolio_purchases` where cast(`vw_portfolio_purchases`.`purchase_date` as date) = cast(curdate() + interval -1 day as date)
md5=ffff04fec3945d7860d79699c14883d7
updatable=0
algorithm=0
definer_user=yeti
definer_host=%
suid=2
with_check_option=0
timestamp=2022-11-24 13:00:45
create-version=2
source=SELECT \'Onboarding Status\' AS status_area, onboarding_status AS status_value, COUNT(*) AS number_of_elements
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select \'Onboarding Status\' AS `status_area`,`vw_claims`.`onboarding_status` AS `status_value`,count(0) AS `number_of_elements` from `yetiforce`.`vw_claims` group by `vw_claims`.`onboarding_status` union all select \'Claim Status\' AS `Claim Status`,`vw_claims`.`claim_status` AS `claim_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_claims` group by `vw_claims`.`claim_status` union all select \'Provider Status\' AS `Provider Status`,`vw_providers`.`provider_status` AS `provider_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_providers` group by `vw_providers`.`provider_status` union all select \'Portfolio Status\' AS `Portfolio Status`,`vw_portfolios`.`portfolio_status` AS `portfolio_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolios` group by `vw_portfolios`.`portfolio_status` union all select \'Portfolio Purchase Status\' AS `Portfolio Purchase Status`,`vw_portfolio_purchases`.`portfolio_purchase_status` AS `portfolio_purchase_status`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolio_purchases` group by `vw_portfolio_purchases`.`portfolio_purchase_status` union all select \'Portfolio Purchases\' AS `Portfolio Purchases`,\'Sent for Signature\' AS `Sent for Signature`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolio_purchases` where cast(`vw_portfolio_purchases`.`sent_be_signed_date` as date) = cast(curdate() + interval -1 day as date) union all select \'Portfolio Purchases\' AS `Portfolio Purchases`,\'Signed/Purchased\' AS `Signed/Purchased`,count(0) AS `COUNT(*)` from `yetiforce`.`vw_portfolio_purchases` where cast(`vw_portfolio_purchases`.`purchase_date` as date) = cast(curdate() + interval -1 day as date)
mariadb-version=100513