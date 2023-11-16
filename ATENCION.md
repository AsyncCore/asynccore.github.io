# <span style="color: red;">!ATENCIÓN¡ - WARNING! - ACHTUNG!<span>

## <span style="color: red;">!ATENCIÓN¡ - WARNING! - ACHTUNG!<span>

### <span style="color: red;">!ATENCIÓN¡ - WARNING! - ACHTUNG!<span>

A partir de hoy 07/11/2023 se ha cambiado el workflow del repositorio. A partir de ahora, todos los pushes van a la rama DEV.

Si queréis hacer cambios poco relevantes, se pushean directamente a dev, con lo que ello supone (cuidado con los merges y con los rebases). Si queréis hacer algo completo, lo que vendría siendo una "feature", sería mejor que tuviéseis una rama a la que llaméis:

### feature/_nombre_de_la_feature_

y que cuando la tengáis lista, hagáis un pull request a la rama dev explicando las cosas con detenimiento. Ya sé que es una puta mierda, pero al menos nos enteramos de qué cojones pasa en el código, que no estamos en tu cabeza.

Se debería esperar a que se revisen y se acepten los cambios, ya que DEV no estará protegida y podréis hacer push directamente, pero no sería lo recomendable. En caso de que se acepten los cambios de una pull request desde una rama de feature, se mergean a dev y se borra la rama de la feature. Si no se acepta, se os pedirá que hagáis los cambios necesarios y se volverá a revisar. Rinse and repeat.

Así ad nauseam. 

Cuando haya cambios significativos en la rama dev, se hará una pull request contra main para tenerlo todo actualizado y listo para el despliegue "real" en producción en los dominios de asyncore (.es, .org, .net, .eu).

Los cambios que se vayan realizando en la rama DEV, se podrán probar contra el servidor de desarrollo en https://dev.asyncore.es, https://dev.asyncore.org, https://dev.asyncore.net y https://dev.asyncore.eu.

Si no sabes cómo utilizar el servidor de desarrollo, pregunta. 

No damos soporte a VSCode, así que si usas VSCode, espera sentado.