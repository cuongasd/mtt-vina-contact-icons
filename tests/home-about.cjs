const fs = require('fs');
const vm = require('vm');
const assert = require('assert');
const code = fs.readFileSync('assets/home-about.js', 'utf8');
function boot({ reduced = false, supported = true, present = true, broken = false } = {}) {
    const classes = new Set();
    const target = {};
    let callback, observed, disconnected = false;
    const section = {
        classList: { add: x => classes.add(x), remove: x => classes.delete(x) },
        querySelector: () => target,
    };
    function Observer(cb) {
        if (broken) throw new Error('unavailable');
        callback = cb;
        this.observe = value => { observed = value; };
        this.disconnect = () => { disconnected = true; };
    }
    const window = { matchMedia: () => ({ matches: reduced }) };
    if (supported) window.IntersectionObserver = Observer;
    vm.runInNewContext(code, { window, document: { querySelector: () => present ? section : null }, IntersectionObserver: Observer });
    return { classes, target, get observed() { return observed; }, get disconnected() { return disconnected; }, enter: value => callback([{ isIntersecting: value }]) };
}
const normal = boot();
assert(normal.classes.has('is-animated'));
assert.strictEqual(normal.observed, normal.target);
normal.enter(false);
assert(!normal.classes.has('is-visible'));
normal.enter(true);
assert(normal.classes.has('is-visible'));
assert(normal.disconnected);
for (const options of [{ reduced: true }, { supported: false }, { present: false }, { broken: true }]) {
    assert(!boot(options).classes.has('is-animated'));
}
console.log('PASS: scroll reveal, reduced motion, no observer, missing section and initialization failure');
