<?php
namespace Brightside\Youtubevideo\Evaluation;

/**
 * Class for field value validation/evaluation to be used in 'eval' of TCA
 */
class HoursMinutesSeconds
{

   /**
    * JavaScript code for client side validation/evaluation
    *
    * @return string JavaScript code for client side validation/evaluation
    */
    public function returnFieldJS()
    {
        return "
            var value = value.replace(/[-|_|,|.|–|']+/g,':');
            var value = value.replace(/[^\d:]+/g,'');
            var value = value.replace(/^:|:$/g, '');
            var p = value.split(':'),
            s = 0, m = 1;
            while (p.length > 0) {
                s += m * parseInt(p.pop(), 10);
                m *= 60;
            }
            if (s > 0) {
                var date = new Date(0);
                date.setSeconds(s);
                var value = date.toISOString().substr(11, 8);
                return value;
            } else {
                return '';
            }
        ";
    }
}
