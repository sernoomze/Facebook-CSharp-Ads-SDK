<?php

/**
 * Check if the application has been initialized
 */
if (defined("__SDK_CONVERTER__") == false) exit("Application not initialized");

/** Variable declarations for PhpStorm */
/** @var \SdkConverter\Object\ClassReader $class */
require("FacebookAds.Header.php"); ?>

namespace FacebookAds.Object
{
    public class <?= $class->getClassName(); ?> : AbstractCrudObject
    {
        /// <summary>
        /// Initializes a new instance of the <see cref="<?= $class->getClassName(); ?>"/> class.
        /// </summary>
        /// <param name="id">The identifier.</param>
        /// <param name="parentId">The parent identifier.</param>
        /// <param name="client">The client.</param>
        public <?= $class->getClassName(); ?>(string id, string parentId = null, FacebookClient client = null) : base(id, parentId, client) { }

        /// <summary>Gets the endpoint of the API call.</summary>
        /// <returns>Endpoint URL</returns>
        protected override string GetEndpoint()
        {
            return "<?= $class->getEndPoint(); ?>";
        }
        <?php foreach($class->getMethods() as $method): ?>

<?php if ($method->getMethodEndpoint() != null): ?>
        /// <summary>
        /// <?= $method->getDocumentation(); ?>.
        /// </summary>
        /// <param name="fields">The fields.</param>
        /// <param name="parameters">The parameters.</param>
        /// <returns>The result of <see cref="Facebook.FacebookClient"/>.Get()</returns>
        public object <?= $method->getMethodName(); ?>(string[] fields = null, Dictionary<string, object> parameters = null)
        {
            return this.<?= $method->getConnectionMethod(); ?>("<?= $method->getMethodEndpoint(); ?>", fields, parameters);
        }<?php endif; ?>

<?php endforeach; ?>

    }
}


