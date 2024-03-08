document.addEventListener("DOMContentLoaded", function () {
    function copyToClipboard(elem) {
        var target = elem;

        // select the content
        var currentFocus = document.activeElement;

        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;

        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            console.warn(e);

            succeed = false;
        }

        // Restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (succeed) {
            $(".copied").animate({ top: -25, opacity: 0 }, 700, function () {
                $(this).css({ top: '50%', opacity: 1 });
            });
        }

        return succeed;
    }

    $("#copyButton, #copyTarget").on("click", function () {
        copyToClipboard(document.getElementById("copyTarget"));
    });

    // add mask
    $('.date').mask("00/0000");

    // delete all spaces if user is pasting card number
    $("#cc-number").on("input", function () {
        $(this).val($(this).val().replace(/\s+/g, ''));
    });

    $(".menu-btn").on("click", () => {
        $(".side-container").toggleClass("active");
    });

    var modern_date = document.querySelector(".modern-input.date");
    if (modern_date) {
        document.querySelector(".modern-input.date").addEventListener('input', function (event) {
            let inputValue = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
            if (inputValue.length > 2) {
                inputValue = inputValue.substring(0, 2) + '/' + inputValue.substring(2);
            }
            event.target.value = inputValue;
        });
    }
});