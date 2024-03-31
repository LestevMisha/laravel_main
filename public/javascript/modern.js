document.addEventListener('livewire:initialized', () => {

    // helper function
    const applyStyles = (label, input = null, isFocused = false) => {
        // Remove previously added classes
        label.classList.remove("active-trans", "inactive-trans", "active-color", "inactive-color");

        // Add the appropriate classes based on the conditions
        const transformValue = isFocused || input?.validity?.valid ? "active-trans" : "inactive-trans";
        const colorValue = isFocused || input?.validity?.valid ? "active-color" : "inactive-color";

        label.classList.add(transformValue);
        label.classList.add(colorValue);
    };


    // helper function
    const main = () => {
        // INPUT
        const modernWrappers = document.querySelectorAll(".modern-wrapper");

        modernWrappers.forEach(modernWrapper => {
            const modernLabel = modernWrapper.querySelector('.modern-label');
            const modernInput = modernWrapper.querySelector('.modern-input');

            applyStyles(modernLabel, modernInput, modernInput.value);
            modernInput.addEventListener("input", applyStyles.bind(null, modernLabel, modernInput, true));
            modernInput.addEventListener("focus", applyStyles.bind(null, modernLabel, modernInput, true));
            modernInput.addEventListener("blur", applyStyles.bind(null, modernLabel, modernInput, false));
        });

        // LEARN/SHOW MORE
        var showChar = 140;
        var ellipsestext = "...";
        var moretext = "Показать больше";
        var lesstext = "Свернуть";

        $('.more').each(function () {
            var content = $(this).text()
            var content_len = content.replace(/\s/g, "").length
            if (content_len > showChar) {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content_len - showChar);
                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                $(this).html(html);
            }
        });

        $(".morelink").click(function () {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    };

    // helper function
    function debounce(func, delay) {
        let timerId;

        return function () {
            const context = this;
            const args = arguments;

            clearTimeout(timerId);
            timerId = setTimeout(() => {
                func.apply(context, args);
            }, delay);
        };
    }

    // helper function
    const debouncedFunc = debounce((el) => {
        main();
    }, 0.1);

    // helper function
    const debouncedEyeFunc = debounce((el) => {
        const modernWrappers = el.closest("form")?.querySelectorAll(".modern-wrapper") ?? null;
        if (modernWrappers) {
            modernWrappers.forEach(moderWrapper => {
                if (moderWrapper.style.display !== "none") {
                    var icon = moderWrapper.querySelector("i");
                    var input = moderWrapper.querySelector("input");
                    if (icon.svg === "Eye") {
                        input.type = "password";
                    } else {
                        input.type = "text";
                    }
                }
            });
        }
    }, 0.1);

    // Run main js
    main();

    // Link js to just rendered components
    Livewire.hook('morph.updated', ({ el, component }) => {
        debouncedFunc(el);
        debouncedEyeFunc(el);
    });
});

const resetListener = (e) => {
    const modernWrapper = e.target.closest(".modern-wrapper");
    const modernInput = modernWrapper.querySelector(".modern-input");
    modernInput.value = null;
    modernInput.focus();
};


const passwordListener = (e) => {
    const modernWrapper = e.target.closest(".modern-wrapper");
    const modernInput = modernWrapper.querySelector(".modern-input");
    const eyeIcon = modernWrapper.querySelector("svg");

    if (modernInput.type === "password") {
        modernInput.type = "text";
        eyeIcon.innerHTML = `<use xlink:href="${location.origin}/images/svg/sprite.svg#ClosedEye">`;
    } else {
        modernInput.type = "password";
        eyeIcon.innerHTML = `<use xlink:href="${location.origin}/images/svg/sprite.svg#Eye">`;
    }
}