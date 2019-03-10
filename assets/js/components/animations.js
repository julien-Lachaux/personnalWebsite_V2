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
    },

    activeOnLoadAnimationFor(elementClassName) {
        
        setTimeout(() => {
            var elements = document.querySelectorAll('.' + elementClassName + '.onLoadElement');
            for (let i = 0; i < elements.length; i++) {
                elements[i].classList.remove('onLoadElement');
            }
        }, 5000);
        
        // OnLoad animation for element
        var lor = 0;
        var elements = document.querySelectorAll('.' + elementClassName);

        for (let i = 0; i < elements.length; i++) {
            elements[i].classList.add('onLoadElement');
            if (lor === 0) {
                elements[i].classList.add('top');
            } else if ((lor % 2) === 0) {
                elements[i].classList.add('left');
            } else {
                elements[i].classList.add('right');
            }
            lor++;
        }
    }

}