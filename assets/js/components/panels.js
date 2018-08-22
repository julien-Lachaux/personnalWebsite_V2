const SVG = require('svg.js')
const panels = {
    animate() {
        let draw = SVG('headerPage')

        // test
        let test = draw.select('polygon.test')
        test.animate(8000, '-').rotate(360).loop()

        // rotation
        let rotatesPath = draw.select('path.rotates')
        rotatesPath.animate(50000, '-').rotate(-360).loop()
        let rotatesPolygon = draw.select('polygon.rotates')
        rotatesPolygon.animate(50000, '-').rotate(-360).loop()

        // fade out
        let fadeOutPath = draw.select('path.fadeOut')
        fadeOutPath.animate(10000, '<>').attr({
            opacity: 0
        }).move(-0.5, -0.5).loop()
        let fadeOutPolygon = draw.select('polygon.fadeOut')
        fadeOutPolygon.animate(10000, '<>').attr({
            opacity: 0
        }).move(100, 100).loop()
    }
}
module.exports = panels