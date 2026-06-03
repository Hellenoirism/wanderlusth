/*
|--------------------------------------------------------------------------
| FORMATTER
|--------------------------------------------------------------------------
*/

const formatter = new Intl.NumberFormat('id-ID');

function parse(value) {

    return String(value || '')
        .replace(/\D/g, '');
}

function format(value) {

    const number = parse(value);

    return number
        ? `Rp ${formatter.format(number)}`
        : '';
}

/*
|--------------------------------------------------------------------------
| FORMAT TEXT
|--------------------------------------------------------------------------
*/

function formatCurrencyText() {

    document
        .querySelectorAll('[data-currency-text]')
        .forEach((element) => {

            element.textContent =
                format(
                    element.dataset.currencyText
                );
        });
}

/*
|--------------------------------------------------------------------------
| FORMAT INPUT
|--------------------------------------------------------------------------
*/

function formatCurrencyInput() {

    document
        .querySelectorAll('[data-currency]')
        .forEach((input) => {

            const target =
                document.getElementById(
                    input.dataset.target
                );

            /*
            |--------------------------------------------------------------------------
            | INITIAL VALUE
            |--------------------------------------------------------------------------
            */

            if (target?.value) {

                input.value =
                    format(target.value);
            }

            /*
            |--------------------------------------------------------------------------
            | INPUT EVENT
            |--------------------------------------------------------------------------
            */

            input.addEventListener('input', () => {

                const numericValue =
                    parse(input.value);

                input.value =
                    format(numericValue);

                if (target) {

                    target.value =
                        numericValue;
                }
            });
        });
}

/*
|--------------------------------------------------------------------------
| INIT
|--------------------------------------------------------------------------
*/

function init() {

    formatCurrencyText();

    formatCurrencyInput();
}

document.addEventListener(
    'DOMContentLoaded',
    init
);

/*
|--------------------------------------------------------------------------
| EXPORT
|--------------------------------------------------------------------------
*/

export default {
    format,
    parse,
    init
};