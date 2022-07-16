<?php
function convertPersianToEnglish($number)
{
    return str_replace(array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $number);
}
function convertArabicToEnglish($number)
{
    return str_replace(array('۰', '۱', '۲', '۳', '٤', '٥', '٦', '۷', '۸', '۹'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $number);
}
function validateNationalCode($nationalCode) : bool
{
    $nationalCode = trim($nationalCode, ' .');
    $nationalCode = convertPersianToEnglish(convertArabicToEnglish($nationalCode));
    $bannedArray = ['0000000000', '1111111111', '2222222222', '3333333333', '4444444444', '5555555555', '6666666666', '7777777777', '8888888888', '9999999999'];
    if (empty($nationalCode)) {
        return false;
    } else if (count(str_split($nationalCode)) != 10) {
        return false;
    } else if (in_array($nationalCode, $bannedArray)) {
        return false;
    } else {
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $nationalCode[$i] * (10 - $i);
        }
        $dividedRemaining = $sum % 11;
        if ($dividedRemaining < 2) {
            $lastDigits = $dividedRemaining;
        } else {
            $lastDigits = 11 - ($dividedRemaining);
        }
        if ((int) $nationalCode[9] == $lastDigits) {
            return true;
        }else{
            return false;
        }
    }
}
validateNationalCode('your national_code'); // => true|false