<?php
date_default_timezone_set('Europe/Paris');
$minutesByFuelLiter = 10000;

$presentTime = new DateTime();
$destinationTime = new DateTime();

$gapMonths = rand(-12, 12);
$gapHours = rand(-24, 24);
$gapMinutes = rand(0, 60);
$text = $gapMonths . ' months ' . $gapHours . ' hours ' . $gapMinutes . ' minutes';

$destinationTime->modify($text);
$diff = $presentTime->diff($destinationTime);
$minutesDiff = getIntervalInMinutes($diff);

$nbrFuelLiters = round($minutesDiff / $minutesByFuelLiter, 2);
/*
echo '$text = ' . $text .  PHP_EOL;
echo '$presentTime' . PHP_EOL;
echo '<pre>', print_r($presentTime), '</pre>' . PHP_EOL;
echo '$destinationTime' . PHP_EOL;
echo '<pre>', print_r($destinationTime), '</pre>' . PHP_EOL;
echo '$diff' . PHP_EOL;
echo '<pre>', print_r($diff), '</pre>' . PHP_EOL;
*/
function getIntervalInMinutes(DateInterval $since_start): int
{
    $minutes = $since_start->days * 24 * 60;
    $minutes += $since_start->h * 60;
    $minutes += $since_start->i;
    return $minutes;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Doc et Marty</title>
</head>

<body>
    <div class="time-container">
        <table class="table-clock">
            <tbody>
                <tr>
                    <th><span class='clock-label'> MONTH </span></th>
                    <th><span class='clock-label'> DAY </span></th>
                    <th><span class='clock-label'> YEAR </span></th>
                    <th rowspan="2">
                        <div class="pm-am-container">
                            <label class='am-label' for="AM">AM</label>
                        </div>
                        <input type="radio" id="AM" name="ante_post_meridiem" value="AM" <?= ($destinationTime->format('a') === 'am') ? 'checked' : '' ?>>
                        <div class="pm-am-container">
                            <label class='pm-label' for="PM">PM</label>
                        </div>
                        <input type="radio" id="PM" name="ante_post_meridiem" value="PM" <?= ($destinationTime->format('a') === 'pm') ? 'checked' : '' ?>>
                    </th>
                    <th><span class='clock-label'> HOUR </span></th>
                    <th><span class='clock-label'> MIN </span></th>
                </tr>
                <tr>
                    <td><span class='clock-value'><?= $destinationTime->format('m') ?></span></td>
                    <td><span class='clock-value'><?= $destinationTime->format('d') ?></span></td>
                    <td><span class='clock-value'><?= $destinationTime->format('Y') ?></span></td>
                    <td><span class='clock-value'><?= $destinationTime->format('h') ?></span></td>
                    <td><span class='clock-value'><?= $destinationTime->format('i') ?></span></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"><span class='label-footer'>DESTINATION TIME</span></td>
                </tr>
            </tfoot>
        </table>
        <table class="table-clock">
            <tbody>
                <tr>
                    <th><span class='clock-label'> MONTH </span></th>
                    <th><span class='clock-label'> DAY </span></th>
                    <th><span class='clock-label'> YEAR </span></th>
                    <th rowspan="2">
                        <div class="pm-am-container">
                            <label class='am-label' for="AM2">AM</label>
                        </div>
                        <input type="radio" id="AM2" name="ante_post_meridiem2" value="AM" <?= ($presentTime->format('a') === 'am') ? 'checked' : '' ?>>
                        <div class="pm-am-container">
                            <label class='pm-label' for="PM2">PM</label>
                        </div>
                        <input type="radio" id="PM2" name="ante_post_meridiem2" value="PM" <?= ($presentTime->format('a') === 'pm') ? 'checked' : '' ?>>
                    </th>
                    <th><span class='clock-label'> HOUR </span></th>
                    <th><span class='clock-label'> MIN </span></th>
                </tr>
                <tr>
                    <td><span class='clock-value green'><?= $presentTime->format('m') ?></span></td>
                    <td><span class='clock-value green'><?= $presentTime->format('d') ?></span></td>
                    <td><span class='clock-value green'><?= $presentTime->format('Y') ?></span></td>
                    <td><span class='clock-value green'><?= $presentTime->format('h') ?></span></td>
                    <td><span class='clock-value green'><?= $presentTime->format('i') ?></span></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"><span class='label-footer'>PRESENT TIME</span></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="time-container">
        <table class="table-clock gap">
            <tbody>
                <tr>
                    <th><span class='clock-label'> MONTH </span></th>
                    <th><span class='clock-label'> DAY </span></th>
                    <th><span class='clock-label'> YEAR </span></th>
                    <th rowspan="2"></th>
                    <th><span class='clock-label'> HOUR </span></th>
                    <th><span class='clock-label'> MIN </span></th>
                </tr>
                <tr>
                    <td><span class='clock-value blue'><?= $diff->m ?></span></td>
                    <td><span class='clock-value blue'><?= $diff->d ?></span></td>
                    <td><span class='clock-value blue '><?= $diff->y ?></span></td>
                    <td><span class='clock-value blue'><?= $diff->h ?></span></td>
                    <td><span class='clock-value blue '><?= $diff->i ?></span></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"><span class='label-footer'>TIME GAP</span></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <span>Nombre de littre(s) pour effectuer le trajet : <?= $minutesDiff ?> / <?= $minutesByFuelLiter ?> = <?= $nbrFuelLiters ?> </span>

</body>

</html>