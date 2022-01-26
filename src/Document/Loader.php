<?php
/**
 * Storage
 *
 * @package Wp_Graphql_Labs
 */

namespace WPGraphQL\Labs\Document;

use WPGraphQL\Labs\Document;
use GraphQL\Server\RequestError;

class Loader {
	/**
	 * When a queryId is found on the request, this call back is invoked to look up the query
	 * string
	 * Can be invoked on GET or POST params
	 *
	 * @param array $query_id         An array containing the pieces of the data of the GraphQL
	 *                                request
	 * @param array $operation_params An array containing the method, body and query params
	 *
	 * @return string | GraphQL\Language\AST\DocumentNode
	 */
	public static function by_query_id( $query_id, $operation_params ) {
		$content = new Document();
		$query   = $content->get( $query_id );

		if ( ! isset( $query ) ) {
			// Translators: The placeholder is the persisted query id hash
			throw new RequestError( sprintf( __( 'Query Not Found %s', 'wp-graphql-labs' ), $query_id ) );
		}

		return $query;
	}
}
