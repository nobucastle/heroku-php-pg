<?php
# This function reads your DATABASE_URL config var and returns a connection
# string suitable for pg_connect. Put this in your app. test
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}

# Here we establish the connection. Yes, that's all.
$pg_conn = pg_connect(pg_connection_string_from_database_url());

# Now let's use the connection for something silly just to prove it works:
# $result = pg_query($pg_conn, "SELECT relname FROM pg_stat_user_tables WHERE schemaname='public'");
$result = pg_query($pg_conn, "SELECT * FROM salesforce.tou_jinji__c where giin_cd__c ='". htmlspecialchars($_REQUEST['giin_cd__c'], ENT_QUOTES, 'UTF-8') . "'" );

print "<pre>\n";

# if (!pg_num_rows($result)) {
#   print("Your connection is working, but your database is empty.\nFret not. This is expected for new apps.\n");
# } else {
#   print "Tables in your database:\n";
#   while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
# }

while ($row = pg_fetch_assoc($result)) {

  echo "Photo<br>";
  echo "<img src='https://www.komei.or.jp/members/member_img/" . $row['giin_cd__c'] . ".jpg' >";
  echo "<hr>";

  echo $row['giin_cd__c'];
  echo "<br>";
  echo $row['name'];
  echo "<br>";
  echo $row['name_kana__c'];
  echo "<br>";
  echo $row['shikaku__c'];
  echo "<br>";
  echo $row['shokuseki__c'];
  echo "<br>";
  echo $row['syubetsu__c'];
  echo "<br>";
  echo "test<br>";
}

print "\n";
?>
