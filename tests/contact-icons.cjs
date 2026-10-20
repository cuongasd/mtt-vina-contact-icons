const fs = require('fs'); const vm = require('vm'); const assert = require('assert');
const code=fs.readFileSync('assets/contact-icons.js','utf8');
function item(kind,href){const attrs={href,target:'_blank',rel:'noopener','data-track':'original'};const classes=new Set([kind]); const button={classList:{contains:k=>classes.has(k),add:k=>classes.add(k)},setAttribute(){},querySelector(){return link}};const link={parentElement:button,textContent:kind==='chat-zalo'?'Chat Zalo':'Hotline: 0353508805',getAttribute:k=>attrs[k]??null,hasAttribute:k=>k in attrs,setAttribute:(k,v)=>attrs[k]=v,appendChild(n){this.icon=n}};return {button,link,attrs};}
const a=item('chat-zalo','http://zalo.me/0353508805'),b=item('hotline','tel:0353508805');
const document={readyState:'complete',querySelectorAll:()=>[a.button,b.button],createElement:()=>({setAttribute(){}})};
vm.runInNewContext(code,{document});
for(const x of [a,b]) {assert.equal(x.link.textContent,'');assert.ok(x.link.icon);assert.equal(x.attrs.target,'_blank');assert.equal(x.attrs.rel,'noopener');assert.equal(x.attrs['data-track'],'original');assert.ok(x.attrs['aria-label']);}
assert.equal(a.attrs.href,'http://zalo.me/0353508805');assert.equal(b.attrs.href,'tel:0353508805');
vm.runInNewContext(code,{document});
vm.runInNewContext(code,{document:{...document,querySelectorAll:()=>[]}});
console.log('PASS: links, attributes, labels, icon insertion, repeat execution, absent CTA');

