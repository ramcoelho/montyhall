#!/usr/bin/php
<?php

$opts = getopt('hsli:d:', ['help', 'stick', 'doors:', 'log', 'iterations:']);

$showHelp = (isset($opts['h']) || isset($opts['help']));

if ($showHelp) {
    echo <<< EOT

Monty Hall Simulation
=====================

Calculates your winning probability in a Monty Hall Paradox game simulation.
Read more: https://en.wikipedia.org/wiki/Monty_Hall_problem

Usage: {$script} [-h] [-l] [-n] [-i <iterations>] [-d <doors>]

Where:
  -h, --help          Show this help
  -s, --stick         Do not switch doors when offered by host - stick with first choice
  -l, --log           Log iterations
  -i, --iterations    How many times should we run the simulation? Defaults to 10000
  -d, --doors         How many doors should we create? Defaults to 3

EOT;
    die();
}

$willingToSwitch = !(isset($opts['s']) || isset($opts['stick']));
$showLog = (isset($opts['l']) || isset($opts['log']));
define('SHOWLOG', $showLog);

$iterations = 10000;
if (isset($opts['i']))
    $iterations = $opts['i'] + 0;
if (isset($opts['iterations']))
    $iterations = $opts['iterations'] + 0;

$doors = 3;
if (isset($opts['d']))
    $doors = $opts['d'] + 0;
if (isset($opts['doors']))
    $doors = $opts['doors'] + 0;

function say($text, $addNewLine = false)
{
    if (SHOWLOG)
        echo $text . ($addNewLine ? "\n" : '');
}

function doorName($door)
{
    return "Door {$door}";
}

$prize = 0;

for ($i = 0; $i < $iterations; $i++) {
    $prizeDoor = rand(0, $doors - 1);
    say("Prize at " . doorName($prizeDoor));
    $chosenDoor = rand(0, $doors - 1);
    say(" - Guest has chosen " . doorName($chosenDoor));
    $excludedDoor = 0;
    while (in_array($excludedDoor, [$chosenDoor, $prizeDoor])) {
        $excludedDoor++;
    }
    say(" - Host excluded " . doorName($excludedDoor));
    if ($willingToSwitch) {
        $newDoor = 0;
        while (in_array($newDoor, [$excludedDoor, $chosenDoor])) {
            $newDoor++;
        }
        $chosenDoor = $newDoor;
        say(" - Guest switched to " . doorName($chosenDoor));
    }
    if ($chosenDoor == $prizeDoor) {
        say(" - CONGRATULATIONS!", true);
        $prize++;
    } else {
        say(" - Maybe next time", true);
    }
}
printf("Winning Probability: %2f\n", ($prize / $iterations));
