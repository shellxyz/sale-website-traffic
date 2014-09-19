Higher priority clients will always show up on top.
JustETC will always have the lowest priority.

onlyUsa.php:



OnlyCanada.php
Will primarily show Canada clients, then north american clients but Never US clients
$sql = " SELECT * FROM web_sites where remaining > 0 and isActive > 0 and isBonus = '0' and country in ('Canada','NA') and is_freezed = 0 order by priority desc, accessed asc limit 1 ";

Only_all.php
SELECT * FROM web_sites where remaining > 0 and isActive > 0 and isBonus = '0' 
and country in ('All') 
order by priority desc, accessed asc limit 1


 