<?php

$db_add = "localhost";
$db = "DATABASE";
$user = "USER";
$password = "PASSWORD";

$groupManager = new api\GroupManager\GroupManager($db_add, $db, $user, $password);

/* Add Right */
$groupManager->addRight('right_one');
$groupManager->addRight('right_two');
$groupManager->addRight('module_test');

/* Del Right */
$groupManager->delRight('right_one');

/* Get Right sql */
$groupManager->setUserRightLvl('test');
echo '<b>Sql level right :</b> <i>'.$groupManager->getUserRightLvl('test').'</i><br />';

/* Simple set Rights Lvl with sql get Right Lvl */
$groupManager->setRightLvl($groupManager->getUserRightLvl('test'));

/* Simple class get Rights */
echo '<b>Level right :</b> <i>'.$groupManager->getRightLvl().'</i><br />';
echo '<br /><b>right :</b><br />';
foreach ($groupManager->getAllRight() as $value) {
    echo '- '.$value.'<br />';
}