# Monty Hall Simulation

Calculates your winning probability in a Monty Hall Paradox game simulation.

Read more: https://en.wikipedia.org/wiki/Monty_Hall_problem

## Why?

To empirically prove a friend wrong.

## Installation

This project requires `php-cli` > 5.4

Just download it and `chmod a+x mh.php`

## Usage 

    ./mh.php [-h] [-l] [-n] [-i <iterations>] [-d <doors>]

## Options

| Option | Description |
| - | - |
| *-h, --help* | Show this help |
| *-s, --stick* | Do not switch doors when offered by host - stick with first choice |
| *-l, --log* | Log iterations |
| *-i, --iterations* | How many times should we run the simulation? Defaults to 10000 |
| *-d, --doors* | How many doors should we create? Defaults to 3 |
