import{d as i,v as _,c as w,w as e,o as x,g as o,a as l,b as a,u as t,C as h,n as v}from"./app-3e297a40.js";import{a as C,b as D}from"./DialogModal-ba3ef82e.js";import{_ as m}from"./DangerButton-eb4265dc.js";import{_ as g,a as y}from"./TextInput-84c6052b.js";import{_ as k}from"./SecondaryButton-ec9d3d06.js";import"./SectionTitle-226bed54.js";import"./_plugin-vue_export-helper-c27b6911.js";const V=l("div",{class:"max-w-xl text-sm text-gray-600"}," Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, faça o download de todos os dados ou informações que deseja reter. ",-1),$={class:"mt-5"},b={class:"mt-4"},E={__name:"DeleteUserForm",setup(q){const r=i(!1),n=i(null),s=_({password:""}),p=()=>{r.value=!0,setTimeout(()=>n.value.focus(),250)},u=()=>{s.delete(route("current-user.destroy"),{preserveScroll:!0,onSuccess:()=>c(),onError:()=>n.value.focus(),onFinish:()=>s.reset()})},c=()=>{r.value=!1,s.reset()};return(U,d)=>(x(),w(C,null,{title:e(()=>[o(" Deletar conta ")]),description:e(()=>[o(" Exclua sua conta permanentemente. ")]),content:e(()=>[V,l("div",$,[a(m,{onClick:p},{default:e(()=>[o(" Deletar conta ")]),_:1})]),a(D,{show:r.value,onClose:c},{title:e(()=>[o(" Deletar Conta ")]),content:e(()=>[o(" Tem certeza de que deseja excluir sua conta? Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Digite sua senha para confirmar que deseja excluir permanentemente sua conta. "),l("div",b,[a(g,{ref_key:"passwordInput",ref:n,modelValue:t(s).password,"onUpdate:modelValue":d[0]||(d[0]=f=>t(s).password=f),type:"password",class:"mt-1 block w-3/4",placeholder:"Senha",autocomplete:"current-password",onKeyup:h(u,["enter"])},null,8,["modelValue","onKeyup"]),a(y,{message:t(s).errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[a(k,{onClick:c},{default:e(()=>[o(" Cancelar ")]),_:1}),a(m,{class:v(["ml-3",{"opacity-25":t(s).processing}]),disabled:t(s).processing,onClick:u},{default:e(()=>[o(" Deletar Conta ")]),_:1},8,["class","disabled"])]),_:1},8,["show"])]),_:1}))}};export{E as default};
