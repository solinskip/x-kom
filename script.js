function get_elapsed_time_string(total_seconds) {
    function pretty_time_string(num) {
        return (num < 10 ? "0" : "") + num;
    }

    let hours = Math.floor(total_seconds / 3600);
    total_seconds = total_seconds % 3600;

    let minutes = Math.floor(total_seconds / 60);
    total_seconds = total_seconds % 60;

    let seconds = Math.floor(total_seconds);

    // Pad the minutes and seconds with leading zeros, if required
    $('#hh').text(pretty_time_string(hours));
    $('#mm').text(pretty_time_string(minutes));
    $('#ss').text(pretty_time_string(seconds));
}

let cTime = new Date;
let deleteH;

if (cTime.getHours() <= 9) deleteH = 9;
else if (cTime.getHours() >= 10 && cTime.getHours() <= 21) deleteH = 21;
else if (cTime.getHours() === 22) deleteH = 11;
else if (cTime.getHours() === 23) deleteH = 13;

let cHours = Math.abs(cTime.getHours() - deleteH) * 3600;
let cMinutes = (59 - cTime.getMinutes()) * 60;
let cSeconds = 60 - cTime.getSeconds();

let elapsed_seconds = cHours + cMinutes + cSeconds;

setInterval(function () {
    elapsed_seconds--;
    get_elapsed_time_string(elapsed_seconds);
    if (elapsed_seconds === 0) window.location.reload();
}, 1000);