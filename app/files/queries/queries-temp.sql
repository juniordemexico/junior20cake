--REPORTE DE CATALOGO DE MATERIALES CON COLORES, FAMILIAS Y COSTOS POR PROVEEDOR
select A.id articulo_id,c.id color_id,a.familia_id,a.arcveart articulo_cve,c.cve color_cve,a.ardescrip descrip,a.arst st,l.licve linea_cve,f.cve familia_cve,p.prcvepro proveedor_cve,ap.costo
from articulo a
JOIN lineas l ON l.id=a.linea_id
LEFT JOIN familias f ON f.id=a.FAMILIA_ID
LEFT JOIN articulos_colores ac on ac.articulo_id=a.id
LEFT JOIN colores c  on c.id=ac.color_id
LEFT JOIN articulos_proveedo2res ap ON ap.articulo_id=a.id
LEFT JOIN proveedores p ON p.id=ap.proveedor_id
where a.tipoarticulo_id=1   and a.arlinea<>'TELA'
order by a.linea_id,a.arst,f.cve,a.arcveart,p.prcvepro




-- Query para actualizar colores en tabla DevolDet (actualiza los registros con los colores actuales)
update devoldet dd set dedcolor=
(SELECT cve FROM articulo a JOIN articulos_colores ac ON a.id=ac.articulo_id JOIN colores c ON c.id=ac.color_id WHERE a.arcveart=dd.dedcveart rows 1 )


WHERE (select defecha from devol d where d.derefer=dd.dedrefer)>='2012/01/01' AND
dd.dedcolor not in (SELECT cve FROM articulo a JOIN articulos_colores ac ON a.id=ac.articulo_id JOIN colores c ON c.id=ac.color_id WHERE a.arcveart=dd.dedcveart) AND
(SELECT dedrefer FROM devoldet dd2 WHERE dd2.dedrefer=dd.dedrefer AND dd2.dedcveart=dd.dedcveart AND dd2.dedcolor=(SELECT cve FROM articulo a JOIN articulos_colores ac ON a.id=ac.articulo_id JOIN colores c ON c.id=ac.color_id WHERE a.arcveart=dd.dedcveart rows 1 ) ) is null




SELECT a.id,a.arcveart,a.arlinea,p.perefer,p.pefecha,p.pest,pd.pedpedido,pd.pedprecio,
(select list(farefer) from factura join facturadet on factura.id=facturadet.factura_id where fast='A' and (factura.pedido_id=p.id or (facturadet.pedido_id=pd.pedido_id and facturadet.articulo_id=pd.ARTICULO_ID) )) factura_folio

FROM ARTICULO a
JOIN pedidodet pd ON a.id=pd.articulo_id
JOIN pedido p ON p.id=pd.PEDIDO_ID

WHERE a.tipoarticulo_id=0 /*and (P.PESURTIDO<>0 AND pd.pedsurtidoya<>0)*/
AND p.pefecha>='2013-07-01' and P.pefecha<='2014-12-10' AND p.pest='A' AND
p.pesurtido<>0 and pd.PEDSURTIDOYA<>0
AND (
(select list(farefer) from factura join facturadet on factura.id=facturadet.factura_id where fast='A' and fafecha>='2013-12-01' and (factura.pedido_id=p.id or (facturadet.pedido_id=pd.pedido_id and facturadet.articulo_id=pd.ARTICULO_ID) ))

) IS NULL


