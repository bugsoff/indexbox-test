<?php

$datasets=['blog','products'];

include __root.DB."init.db.php";
$DB = new initDB(__dbhost, __dbuser, __dbpass, __dbname);

$result=[];
foreach ($datasets as $dataset) {
    if (file_exists(__root.DATA.$dataset.'.json')) {
        $data = json_decode(file_get_contents(__root.DATA.$dataset.'.json'), true);
        $DB->make_table($dataset, $data['columns']);
        $result[$dataset] = ($DB->load_data($dataset, $data))?"OK":"ERR";
    } else {
        throw Err("File $dataset.json not found!");
    }
}
$result["Indexes"] = ($DB->setIndexes())?"OK":"ERR";

exit(json_encode($result, JSON_NUMERIC_CHECK));
