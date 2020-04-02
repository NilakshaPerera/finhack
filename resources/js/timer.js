require('./app');

var forceStop = false;
var i = 0;
var c = null;

function CountdownTracker(label, value) {
    var el = document.createElement('span');
    el.className = 'flip-clock__piece';
    el.innerHTML = '<b class="flip-clock__card card"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b>' +
        '<span class="flip-clock__slot">' + label + '</span>';
    this.el = el;
    var top = el.querySelector('.card__top'),
        bottom = el.querySelector('.card__bottom'),
        back = el.querySelector('.card__back'),
        backBottom = el.querySelector('.card__back .card__bottom');
    this.update = function (val) {
        val = ('0' + val).slice(-2);
        if (val !== this.currentValue) {
            if (this.currentValue >= 0) {
                back.setAttribute('data-value', this.currentValue);
                bottom.setAttribute('data-value', this.currentValue);
            }
            this.currentValue = val;
            top.innerText = this.currentValue;
            backBottom.setAttribute('data-value', this.currentValue);
            this.el.classList.remove('flip');
            void this.el.offsetWidth;
            this.el.classList.add('flip');
        }
    }
    this.update(value);
}

// Calculation adapted from https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/

function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    return {
        'Total': t,
        //'Days': Math.floor(t / (1000 * 60 * 60 * 24)),
        'Hours': Math.floor((t / (1000 * 60 * 60)) % 24),
        'Minutes': Math.floor((t / 1000 / 60) % 60),
        'Seconds': Math.floor((t / 1000) % 60)
    };
}

function getTime() {
    var t = new Date();
    return {
        'Total': t,
        'H': t.getHours() % 12,
        'M': t.getMinutes(),
        'S': t.getSeconds()
    };
}

var timeOutCallback = function () {
    var quizState = window.localStorage.getItem("quiz");
    var result = getRedirParams(quizState);
    setSessionState(result['stage'], "ended");

    if (forceStop) {
        window.location.href = '/#' + result['dir'];
    } else {
        $("#modalTimeoutRedirect").attr("href", '/#' + result['dir']);
        $('#modalTimeOut').modal('toggle');
    }
}

function Clock(countdown, callback) {
    countdown = countdown ? new Date(Date.parse(countdown)) : false;
    callback = callback || function () {};
    var updateFn = countdown ? getTimeRemaining : getTime;
    this.el = document.createElement('div');
    this.el.className = 'flip-clock';
    this.forceStop = false;
    var trackers = {},
        t = updateFn(countdown),
        key, timeinterval;
    for (key in t) {
        if (key === 'Total') {
            continue;
        }
        trackers[key] = new CountdownTracker(key, t[key]);
        this.el.appendChild(trackers[key].el);
    }

    this.stopTimer = function () {
        forceStop = true;
    }

    function updateClock() {
        timeinterval = requestAnimationFrame(updateClock);

        if (i++ % 10) {
            return;
        }
        var t = updateFn(countdown);

        if (t.Total < 0 || forceStop) {
            cancelAnimationFrame(timeinterval);
            for (key in trackers) {
                trackers[key].update(0);
            }
            callback();
            return;
        }
        for (key in trackers) {
            trackers[key].update(t[key]);
        }
    }
    setTimeout(updateClock, 500);
}

var setTimer = function (time) {
    //console.clear();
    forceStop = false;
    var deadline = new Date(Date.parse(new Date()) + time);
    c = new Clock(deadline, timeOutCallback);
    clearClock();
    document.getElementById("clock-el").appendChild(c.el);
}

var getRedirParams = function (quizState) {
    var arr = [];
    var stage = '';
    var dir = '';
    switch (quizState) {
        case 1:
        case '1':
            stage = 'mcq'
            dir = '/quiz-complete';
            break;
        case 2:
        case '2':
            stage = 'puzzle'
            dir = '/puzzle-complete';
            break;
        case 3:
        case '3':
            stage = 'presentation'
            dir = '/presentation-complete';
            break;
        default:
            stage = ''
            dir = '/';
            break;
    }
    arr['stage'] = stage;
    arr['dir'] = dir;
    return arr;
}

var jinjibiris = function (currentObj, startState = null, endState = 1, quizType = "mcq") {
    var obj = JSON.parse(window.localStorage.getItem("a76385aca2174c81b2b81c9032033b9b"));
    var state = window.localStorage.getItem("quiz");
    if (state == startState) {

        var timeStamp = setSessionState(quizType, "started");
        window.localStorage.setItem("quiz", endState);

        setTimer(parseInt(obj[quizType].timeoutin) * 1000);

    } else if (state == endState && !obj[quizType].ended) {
        var currentTime = parseInt(new Date().getTime() / 1000);
        var startedTime = parseInt(obj[quizType].started);
        var timeOut = parseInt(obj[quizType].timeoutin);

        var dif = timeOut - (currentTime - startedTime);
        setTimer(dif * 1000);
    } else {
        var result = getRedirParams(state);
        currentObj.$router.push(result['dir']);
    }
}

var setSessionState = function (quizType, state) {
    var timestamp = parseInt(new Date().getTime() / 1000);
    axios
        .post("set-session-state", {
            quiz: quizType,
            state: state,
            timestamp: timestamp
        })
        .then(function (response) {
            if (response.data.success) {
                var obj = JSON.parse(window.localStorage.getItem("a76385aca2174c81b2b81c9032033b9b"));
                obj[quizType][state] = response.data.message[state];
                window.localStorage.setItem("a76385aca2174c81b2b81c9032033b9b", JSON.stringify(obj));
            } else {}
        })
        .catch(function (error) {
            console.log(error);
        });
    return timestamp;
}

var stopTimer = function () {
    forceStop = true;
    c.stopTimer();
}

var clearClock = function () {
    document.getElementById("clock-el").innerHTML = '';
}

var modalshow=function(){
    $('#modalProgress').modal('toggle');
}

var modalhide=function(){
    $('#modalProgress').modal('toggle');
}

const timer = {
    timeOutCallback,
    setTimer,
    setSessionState,
    jinjibiris,
    stopTimer,
    modalshow,
    modalhide
};
export default timer;
