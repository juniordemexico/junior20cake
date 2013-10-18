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

