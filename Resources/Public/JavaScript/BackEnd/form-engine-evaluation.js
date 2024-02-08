import FormEngineValidation from "@typo3/backend/form-engine-validation.js";
export class FormEngineEvaluation {
  static registerCustomEvaluation(t) {
    FormEngineValidation.registerCustomEvaluation(t, FormEngineEvaluation.evaluateSourceHost)
  }
  static evaluateSourceHost(t) {
    // Replace characters
    t = t.replace(/[-|_|,|.|–|']+/g, ':');
    t = t.replace(/[^\d:]+/g, '');
    t = t.replace(/^:|:$/g, '');

    // Calculate time
    var p = t.split(':');
    var s = 0,
      m = 1;
    while (p.length > 0) {
      s += m * parseInt(p.pop(), 10);
      m *= 60;
    }

    // Check if valid time
    if (s > 0) {
      var date = new Date(0);
      date.setSeconds(s);
      t = date.toISOString().substr(11, 8);
      return t;
    } else {
      return '';
    }
  }
}
