import{v as d,e as r,b as e,u as a,w as o,F as c,o as l,X as f,t as _,f as p,a as t,n as g,g as h,k as b}from"./app-2c41e932.js";import{A as v}from"./AuthenticationCard-4514152a.js";import{_ as x}from"./AuthenticationCardLogo-437fbd66.js";import{_ as k,a as V}from"./TextInput-dfd84d29.js";import{_ as w}from"./InputLabel-1a25ae54.js";import{_ as y}from"./PrimaryButton-5451fb26.js";import"./_plugin-vue_export-helper-c27b6911.js";const q=t("div",{class:"mb-4 text-sm text-gray-600"}," Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um e-mail com um link de redefinição de senha que permitirá que você escolha um novo. ",-1),S={key:0,class:"mb-4 font-medium text-sm text-green-600"},$=["onSubmit"],B={class:"flex items-center justify-end mt-4"},L={__name:"ForgotPassword",props:{status:String},setup(m){const s=d({email:""}),n=()=>{s.post(route("password.email"))};return(C,i)=>(l(),r(c,null,[e(a(f),{title:"Esqueceu senha"}),e(v,null,{logo:o(()=>[e(x)]),default:o(()=>[q,m.status?(l(),r("div",S,_(m.status),1)):p("",!0),t("form",{onSubmit:b(n,["prevent"])},[t("div",null,[e(w,{for:"email",value:"Email"}),e(k,{id:"email",modelValue:a(s).email,"onUpdate:modelValue":i[0]||(i[0]=u=>a(s).email=u),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(V,{class:"mt-2",message:a(s).errors.email},null,8,["message"])]),t("div",B,[e(y,{class:g({"opacity-25":a(s).processing}),disabled:a(s).processing},{default:o(()=>[h(" Link de redefinição de senha de e-mail ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{L as default};
