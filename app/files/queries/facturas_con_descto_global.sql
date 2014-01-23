select f.id,f.farefer,f.fasuma,cast(f.fatotal as numeric(14,2)) fatotal,f.fadesc1,fd.fadcant,fd.fadprecio,fd.fadimporteneto,
cast(fd.fadprecio*.95 as numeric(12,4)) precio_correcto,
cast(cast(fd.fadprecio*.95 as numeric(12,4))*fd.fadcant as numeric(12,4)) importe_correcto,

cast((select sum(cast(fd.fadprecio*.95 as numeric(14,6))*fd2.fadcant) from facturadet fd2 where fd2.factura_id=f.id) as numeric(14,2))*1.16 total_con_descto 
from factura f
join facturadet fd on f.id=fd.factura_id
where f.farefer>='B0060000' and f.farefer<='B061800' and
(f.fadesc1<>0 or f.fadesc2<>0 or f.fadesc3<>0)

