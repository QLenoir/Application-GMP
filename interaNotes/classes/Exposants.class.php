<?php
abstract class Exposants extends BasicEnum {

    const DIX_PUISSANCE_12 = "12";
    const DIX_PUISSANCE_9 = "9";
    const DIX_PUISSANCE_6 = "6";
    const DIX_PUISSANCE_3 = "3";
    const DIX_PUISSANCE_0 = "0";
    const DIX_PUISSANCE_NEGATIVE_3 = "-3";
    const DIX_PUISSANCE_NEGATIVE_6 = "-6";
    const DIX_PUISSANCE_NEGATIVE_9 = "-9";
    const DIX_PUISSANCE_NEGATIVE_12 = "-12";

    public static function getExposantParDefaut() {
        return self::DIX_PUISSANCE_0;
    }
}
