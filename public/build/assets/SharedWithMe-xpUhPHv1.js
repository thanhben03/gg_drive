import{A as C}from"./AuthenticatedLayout-l7-ZxOOj.js";import{_ as V,h as M}from"./http-helper--CrT2N5H.js";import{_ as x}from"./Checkbox-4aAaSSK5.js";import{_ as O}from"./DownloadFileButton-KLs4OlVd.js";import{j as c,h as S,p as j,k as F,o as u,f as m,a as r,u as $,Z as I,w as N,b as a,F as f,q as U,n as A,d as B,t as v,g as D,O as E}from"./app-ImTeHo3O.js";import"./ApplicationLogo-yTz1-3l3.js";import"./_plugin-vue_export-helper-x3n3nnut.js";import"./Modal-qVR1ryoo.js";import"./TextInput-vBC3avoD.js";import"./SecondaryButton-yAsrplH_.js";import"./PrimaryButton-firhvslF.js";const L={class:"flex items-center justify-end p-1 mb-3"},T={class:"flex-1 overflow-auto"},W={class:"min-w-full"},q={class:"bg-gray-100 border-b"},z={class:"text-sm font-medium text-gray-900 px-6 py-4 text-left w-[30px] max-w-[30px] pr-0"},G=a("th",{class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Name ",-1),P=a("th",{class:"text-sm font-medium text-gray-900 px-6 py-4 text-left"}," Path ",-1),Z=["onClick","onDblclick"],H={class:"px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 w-[30px] max-w-[30px] pr-0"},J={class:"px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex items-center"},K={class:"px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"},Q={key:0,class:"py-8 text-center text-sm text-gray-400"},ie={__name:"SharedWithMe",props:{files:Object,folder:Object,ancestors:Object},setup(_){const o=c(!1),l=c({}),p=c(null),i=_,s=c({data:i.files.data,next:i.files.links.next}),g=S(()=>Object.entries(l.value).filter(e=>e[1]).map(e=>e[0]));function b(e){e.is_folder&&E.visit(route("myFiles",{folder:e.path}))}function y(){console.log("load more"),console.log(s.value.next),s.value.next!==null&&M(s.value.next).then(e=>{s.value.data=[...s.value.data,...e.data],s.value.next=e.links.next})}function k(){s.value.data.forEach(e=>{l.value[e.id]=o.value})}function w(e){l.value[e.id]=!l.value[e.id],h(e)}function h(e){if(!l.value[e.id])o.value=!1;else{let n=!0;for(let t of s.value.data)if(!l.value[t.id]){n=!1;break}o.value=n}}return j(()=>{s.value={data:i.files.data,next:i.files.links.next}}),F(()=>{new IntersectionObserver(n=>n.forEach(t=>t.isIntersecting&&y()),{rootMargin:"-250px 0px 0px 0px"}).observe(p.value)}),(e,n)=>(u(),m(f,null,[r($(I),{title:"Share With Me"}),r(C,null,{default:N(()=>[a("nav",L,[a("div",null,[r(O,{all:o.value,ids:g.value,class:"mr-2","shared-with-me":!0},null,8,["all","ids"])])]),a("div",T,[a("table",W,[a("thead",q,[a("tr",null,[a("th",z,[r(x,{onChange:k,checked:o.value,"onUpdate:checked":n[0]||(n[0]=t=>o.value=t)},null,8,["checked"])]),G,P])]),a("tbody",null,[(u(!0),m(f,null,U(s.value.data,t=>(u(),m("tr",{key:t.id,onClick:d=>w(t),onDblclick:d=>b(t),class:A(["border-b transition duration-300 ease-in-out hover:bg-blue-100 cursor-pointer",l.value[t.id]||o.value?"bg-blue-50":"bg-white"])},[a("td",H,[r(x,{onChange:d=>h(t),modelValue:l.value[t.id],"onUpdate:modelValue":d=>l.value[t.id]=d,checked:l.value[t.id]||o.value},null,8,["onChange","modelValue","onUpdate:modelValue","checked"])]),a("td",J,[r(V,{file:t},null,8,["file"]),B(" "+v(t.name),1)]),a("td",K,v(t.path),1)],42,Z))),128))])]),s.value.data.length?D("",!0):(u(),m("div",Q," There is no data in this folder ")),a("div",{ref_key:"loadMoreIntersect",ref:p},null,512)])]),_:1})],64))}};export{ie as default};
