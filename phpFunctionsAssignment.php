<?php

    //  variables

    $myBirthday = strtotime("02/05/1999");
    $message = "  THere Are MAnY FLoweRs IN dmacc FiELds!   ";
    $phoneNum = 1234567890;
    $moneyNum = 123456;

    //  date formatting functions

    function formatDateUS($inDate): string {
        return "<h3> My American Birthday: " . date("m/d/Y", $inDate) . "</h3>";
    }

    function formatDateEU($inDate): string {
        return "<h3> My European Birthday: " . date("d/m/Y", $inDate) . "</h3>";
    }

    //  string formatting functions

    function formatString($inStr) {
        $numChar = strlen($inStr);
        $formattedStr = trim($inStr);
        $formattedStr = strtolower($formattedStr);
        $containsDMACC = stripos($inStr, "DMACC");

        if ($containsDMACC == "") {
            $containsDMACC = "false";
        }

        return "<ul> <strong>String:</strong> " . "<li> Unformatted Str: " . $inStr . "</li>" . "<li> #Char: "
            . $numChar . "</li>" . "<li> DMACC Found: " . $containsDMACC . "</li>" . "<li> Formatted Str: "
            . $formattedStr . "</li></ul>";
    }

    //  number formatting functions

    function formatPhoneUS($inNum) {
        //  code taken and learned from ChatGPT and W3Schools
        return sprintf("(%s) %s-%s", substr($inNum, 0, 3), substr($inNum, 3, 3), substr($inNum, 6)) . "<br>";
    }

    function formatCurrencyUSD($inNum): string {
        return "$" . number_format($inNum, 2, ".", ",");
    }

    //  output to the browser

    echo formatDateUS($myBirthday);

    echo formatDateEU($myBirthday);

    echo formatString($message);

    echo formatPhoneUS($phoneNum);

    echo formatCurrencyUSD($moneyNum);

