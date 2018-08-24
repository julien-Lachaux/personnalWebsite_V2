export const animations = {

    fadeOut(element, duration, ease, x, y) {
        element.animate(duration, ease).attr({
            opacity: 0
        }).dmove(x, y).loop()
    },

    rotate(element, duration, ease) {
        element.animate(duration, ease).rotate(-360).loop()
    },

    easeInOut(element, steps) {
        let startingStep = steps[0]
        steps.splice(0, 1)
        element.animate(startingStep.duration, startingStep.ease, startingStep.delay).during(() => {
            steps.forEach((step) => {
                element.animate(step.duration, step.ease, step.delay).dmove(step.move.x, step.move.y)
            })
        })
    }

}