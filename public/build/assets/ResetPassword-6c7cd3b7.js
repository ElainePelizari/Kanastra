import{v as c,e as f,b as e,u as a,w as l,F as _,o as w,X as g,a as t,n as V,g as b,k}from"./app-2c41e932.js";import{A as v}from"./AuthenticationCard-4514152a.js";import{_ as S}from"./AuthenticationCardLogo-437fbd66.js";import{_ as m,a as i}from"./TextInput-dfd84d29.js";import{_ as n}from"./InputLabel-1a25ae54.js";import{_ as h}from"./PrimaryButton-5451fb26.js";import"./_plugin-vue_export-helper-c27b6911.js";const x=["onSubmit"],y={class:"mt-4"},$={class:"mt-4"},A={class:"flex items-center justify-end mt-4"},z={__name:"ResetPassword",props:{email:String,token:String},setup(p){const d=p,s=c({token:d.token,email:d.email,password:"",password_confirmation:""}),u=()=>{s.post(route("password.update"),{onFinish:()=>s.reset("password","password_confirmation")})};return(C,o)=>(w(),f(_,null,[e(a(g),{title:"Alterar Senha"}),e(v,null,{logo:l(()=>[e(S)]),default:l(()=>[t("form",{onSubmit:k(u,["prevent"])},[t("div",null,[e(n,{for:"email",value:"Email"}),e(m,{id:"email",modelValue:a(s).email,"onUpdate:modelValue":o[0]||(o[0]=r=>a(s).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(i,{class:"mt-2",message:a(s).errors.email},null,8,["message"])]),t("div",y,[e(n,{for:"password",value:"Senha"}),e(m,{id:"password",modelValue:a(s).password,"onUpdate:modelValue":o[1]||(o[1]=r=>a(s).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(i,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),t("div",$,[e(n,{for:"password_confirmation",value:"Confirmar Senha"}),e(m,{id:"password_confirmation",modelValue:a(s).password_confirmation,"onUpdate:modelValue":o[2]||(o[2]=r=>a(s).password_confirmation=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(i,{class:"mt-2",message:a(s).errors.password_confirmation},null,8,["message"])]),t("div",A,[e(h,{class:V({"opacity-25":a(s).processing}),disabled:a(s).processing},{default:l(()=>[b(" Alterar Senha ")]),_:1},8,["class","disabled"])])],40,x)]),_:1})],64))}};export{z as default};
