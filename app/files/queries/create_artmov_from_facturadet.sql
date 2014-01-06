INSERT INTO ArtMov(articulo_id, color_id, talla_id, amCveArt,amColor,
amTMov,amFecha,amRefer,
amAlmacen,amConcep, amCveCli,amPrecio,
amT0,amT1,amT2,amT3,amT4,amT5,amT6,amT7,amT8,amT9,amT, 
crefec, creusr)

SELECT fd.articulo_id, fd.color_id, a.talla_id, fd.fadcveart,fd.fadcolor, 
-5, f.fafecha, f.farefer, 
f.faalmacen, 'FACTURA', f.facvecli, fd.fadImporteNeto/fd.fadcant,
fd.fadt0, fd.fadt1, fd.fadt2, fd.fadt3, fd.fadt4, fd.fadt5, fd.fadt6, fd.fadt7, fd.fadt8,fd.fadt9, f.fat,
fd.crefec,fd.creusr
FROM factura f
JOIN facturadet fd on f.id=fd.factura_id
JOIN articulo a on a.id=fd.articulo_id
JOIN colores c on c.id=fd.color_id
LEFT JOIN artmov am on am.articulo_id=fd.articulo_id and am.color_id=fd.color_id and am.amrefer=f.farefer

WHERE f.fafecha>='2013-01-01' AND am.id is null AND f.fast='A'





/* borrar mov de facturas duplicados*/
delete from artmov WHERE
id in 
(
select k2.id artmov2_id
from artmov k
join artmov k2 on k.articulo_id=k2.articulo_id and k.color_id=k2.color_id and k.id<>k2.id and k2.id>k.id and k.amrefer=k2.amrefer and k.amsal=k2.amsal
and k.amtmov=k2.amtmov
where k.amtmov in (-5,5) 
order by k.id
)

/* Rellenar el Inv Fisico */
DELETE FROM IFISICOS;
insert into ifisicos(id,articulo_id,color_id,talla_id,existencia)
select gen_id(tmp,1), a.id articulo_id, c.id color_id, a.talla_id,
coalesce(SUM(k.AMENT-k.AMSAL),0) existencia

FROM articulo a
JOIN articulos_colores ac ON ac.articulo_id=a.id
JOIN colores c ON c.id=ac.color_id
LEFT JOIN artmov k ON k.articulo_id=a.id and k.color_id=c.id
where a.tipoarticulo_id=0 and a.arcveart not like 'Z%'
group by a.id,c.id,a.talla_id;


commit;




/* Actualiza kardex para dejarlo consistente con los colores especificados en catalogo */
select am.id artmov_id,am.amfecha ,am.amrefer,am.ament entradas,am.amsal salidas,am.articulo_id,am.color_id,am.amcolor,
 (SELECT color_id from articulos_colores ac where ac.articulo_id=am.articulo_id) color_id_catalogo, 
(SELECT c2.cve from articulos_colores ac2 join colores c2 on ac2.color_id=c2.id where ac2.articulo_id=am.articulo_id) color_cve_talogo,
(select min(am3.color_id) ||', '||max(am3.color_id) from artmov am3 where am3.articulo_id=am.articulo_id and am3.color_id<>am.color_id group by am3.articulo_id) colores_en_kardex,
crefec,creusr,modfec,modusr

from artmov am
WHERE 
(select count(*) from articulos_colores ac where ac.articulo_id=am.articulo_id)=1
and (select color_id from artmov am2 where am2.articulo_id=am.articulo_id and am2.color_id<>am.color_id rows 1) is not null


update artmov am set color_id=(SELECT color_id from articulos_colores ac where ac.articulo_id=am.articulo_id), 
amcolor=(SELECT c2.cve from articulos_colores ac2 join colores c2 on ac2.color_id=c2.id where ac2.articulo_id=am.articulo_id)
WHERE (select count(*) from articulos_colores ac where ac.articulo_id=am.articulo_id)=1
and (select coalesce(count(*),0) from artmov am2 where am2.articulo_id=am.articulo_id group by am2.articulo_id,am2.color_id)<>1

