select min(v.vecveven) vendedor_cve, min(a.arcveart) articulo_cve, 
pd.fadprecio precio_fac,min(a.arpvc) precio_cat,cast(sum(pd.fadimporte) as numeric(14,2)) total_importe, cast(sum(pd.fadcant) as integer) total_pzas,
min(v.venom) vendedor_nom,pd.articulo_id articulo_id,v.id vendedor_id
from factura p
join vendedores v on v.id=p.vendedor_id
join facturadet pd on pd.factura_id=p.id
join articulo a on a.id=pd.articulo_id
join catalogo cat on cat.catalogo_id=78273 and cat.articulo_id=pd.articulo_id
left join pedido ped on ped.id=p.pedido_id
where p.fafecha>='2013-04-01' and ped.idcat=78273

group by v.vecveven,v.id,pd.articulo_id,pd.fadprecio
order by v.vecveven,v.id,pd.articulo_id,pd.fadprecio ASC
