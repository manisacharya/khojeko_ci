var snapSlider = document.getElementById('slider-snap');
var $min = $('#min_price').text();
var $max = $('#max_price').text();

noUiSlider.create(snapSlider, {
    start: [ 500, 10000 ],
    step: 500,
    behaviour: 'drag',
    connect: true,
    range: {
        'min' : 500,
        'max' : 10000
    },
    format: wNumb ({
        decimals: 0
    })
});

var snapValues = [
    document.getElementById('slider-snap-value-lower'),
    document.getElementById('slider-snap-value-upper')
];

snapSlider.noUiSlider.on('update', function( values, handle ) {
    snapValues[handle].value = values[handle];
});
