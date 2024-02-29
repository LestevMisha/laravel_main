document.addEventListener('livewire:initialized', () => {

    // helper function
    const applyStyles = (label, input = null, isFocused = false) => {
        const transformValue = isFocused || input?.validity?.valid ? "translateY(-10px) scale(0.87)" : "translateY(0) scale(1.0)";
        const colorValue = isFocused || input?.validity?.valid ? "rgba(0, 0, 0, 0.8)" : "rgba(0, 0, 0, 1.0)";
        label.setAttribute("style", `transform: ${transformValue} !important; color: ${colorValue} !important`);
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
                console.log(h)
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


    // Run main js
    main();

    // Link js to just rendered components
    Livewire.hook('morph.updated', ({ el, component }) => {
        debouncedFunc(el);
    });
})

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
        eyeIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M10.94,6.08A6.93,6.93,0,0,1,12,6c3.18,0,6.17,2.29,7.91,6a15.23,15.23,0,0,1-.9,1.64,1,1,0,0,0-.16.55,1,1,0,0,0,1.86.5,15.77,15.77,0,0,0,1.21-2.3,1,1,0,0,0,0-.79C19.9,6.91,16.1,4,12,4a7.77,7.77,0,0,0-1.4.12,1,1,0,1,0,.34,2ZM3.71,2.29A1,1,0,0,0,2.29,3.71L5.39,6.8a14.62,14.62,0,0,0-3.31,4.8,1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20a9.26,9.26,0,0,0,5.05-1.54l3.24,3.25a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Zm6.36,9.19,2.45,2.45A1.81,1.81,0,0,1,12,14a2,2,0,0,1-2-2A1.81,1.81,0,0,1,10.07,11.48ZM12,18c-3.18,0-6.17-2.29-7.9-6A12.09,12.09,0,0,1,6.8,8.21L8.57,10A4,4,0,0,0,14,15.43L15.59,17A7.24,7.24,0,0,1,12,18Z">
                </path>
            </svg>`;
    } else {
        modernInput.type = "password";
        eyeIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z">
                </path>
            </svg>`;
    }
}
