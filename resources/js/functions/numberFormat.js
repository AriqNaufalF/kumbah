function decimalToPercent(num) {
    return new Intl.NumberFormat('en-US', {
        style: 'percent',
        minimumFractionDigits: 0,
        maximumFractionDigits: 1,
    }).format(num);
}

function toRupiah(num) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(num);
}

function percentToDecimal(stringNum) {
    const intNum = parseInt(stringNum.slice(0, -1));
    if (intNum === NaN) {
        return NaN;
    }
    return intNum / 100;
}

export { decimalToPercent, toRupiah, percentToDecimal };
