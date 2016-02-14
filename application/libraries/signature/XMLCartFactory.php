<?php
	require_once("CartFactory.php");
/*	
 * Returns a simple static cart to generate a signature from,
 * and the final complete cart html.
 *
 * Copyright 2008-2011 Amazon.com, Inc., or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 *    http://aws.amazon.com/apache2.0/
 *
 * or in the "license" file accompanying this file.
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 * either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */
class XMLCartFactory extends CartFactory {
   protected static $CART_ORDER_INPUT_FIELD ="type:merchant-signed-order/aws-accesskey/1;order:[ORDER];signature:[SIGNATURE];aws-access-key-id:[AWS_ACCESS_KEY_ID]";
	
   public function XMLCartFactory() {
   }

   /**
    * Gets cart html fragment used to generate entire cart html
    * Base 64 encode the cart.
    * 
    */
    public function getCart($merchantID, $awsAccessKeyID, $quotationdetails) {
        $cartXML = $this->getCartXML($merchantID, $awsAccessKeyID, $quotationdetails);
        return base64_encode($cartXML);
    }
   
   /**
    * Returns the concatenated cart used for signature generation.
    * @see CartFactory
    */
   public function getSignatureInput($merchantID, $awsAccessKeyID,$quotationdetails) {
        return $this->getCartXML($merchantID, $awsAccessKeyID, $quotationdetails);
   }

   /**
    * Returns a finalized full cart html including the base 64 encoded cart,
    * signature, and buy button image link.
    */
   public function getCartHTML($merchantID, $awsAccessKeyID, $signature, $quotationdetails) {
        $cartHTML = '';

	$cartHTML = $cartHTML . CartFactory::$CART_JAVASCRIPT_START;
	$cartHTML = $cartHTML . CartFactory::$CBA_BUTTON_DIV;       
	// construct the order-input section
	$encodedCart = $this->getCart($merchantID, $awsAccessKeyID, $quotationdetails);
      
		$input = ereg_replace("\\[ORDER\\]", $encodedCart, XMLCartFactory::$CART_ORDER_INPUT_FIELD);
        $input = ereg_replace("\\[SIGNATURE\\]", $signature, $input);
        $input = ereg_replace("\\[AWS_ACCESS_KEY_ID\\]", $awsAccessKeyID, $input);
        $widgetScript = ereg_replace("\\[CART_TYPE\\]", "XML",CartFactory::$STANDARD_CHECKOUT_WIDGET_SCRIPT);
        $widgetScript = ereg_replace("\\[MERCHANT_ID\\]", $merchantID,$widgetScript);
        $widgetScript =ereg_replace ("\\[CART_VALUE\\]",$input ,$widgetScript);
	
	/*
		$input = ereg_replace("\\[ORDER\\]", $encodedCart, XMLCartFactory::$CART_ORDER_INPUT_FIELD);
        $input = ereg_replace("\\[SIGNATURE\\]", $signature, $input);
        $input = ereg_replace("\\[AWS_ACCESS_KEY_ID\\]", $awsAccessKeyID, $input);
        $widgetScript = ereg_replace("\\[CART_TYPE\\]", "XML",CartFactory::$STANDARD_CHECKOUT_WIDGET_SCRIPT);
        $widgetScript = ereg_replace("\\[MERCHANT_ID\\]", $merchantID,$widgetScript);
        $widgetScript =ereg_replace ("\\[CART_VALUE\\]",$input ,$widgetScript);
	*/	
        $cartHTML = $cartHTML . $widgetScript;        

	return $cartHTML;
   }
	
    /**
     * Replace with your own cart here to try out
     * different promotions, tax, shipping, etc. 
     * 
     * @param merchantID
     * @param awsAccessKeyID
     */
    private function getCartXML($merchantID, $awsAccessKeyID, $quotationdetails) {
		//print_r($quotationdetails);
		
        $str = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
	    "<Order xmlns=\"http://payments.amazon.com/checkout/2008-06-15/\">" .
	    "    <ClientRequestId>123457</ClientRequestId>" .
	    "    <Cart>" .
	    "    <Items>" ;
	    foreach($quotationdetails['itemdetails'] as $row)
		{
			$str .= "<Item>";
			$str .= "<SKU>".$row['itemcode']."</SKU>";
			$str .= "<MerchantId>" . $merchantID . "</MerchantId>";
			$str .= "<Title>".$row['description']."</Title>";
			$str .= "<Price>";
				$str .= "<Amount>".$row['price']."</Amount>";
				$str .= "<CurrencyCode>INR</CurrencyCode>";
			$str .= "</Price>";
			$str .= "<Quantity>".$row['quantity']."</Quantity>";
			$str .= "</Item>";
		}
		
		$str .="    </Items>" .
	    "    </Cart>";
	    $str .= "<ReturnUrl>http://52.74.245.165/payment/onlinepayment/success</ReturnUrl>";
	    $str .= "</Order>";

		return $str;
		//exit;
		/*
		return
	    "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
	    "<Order xmlns=\"http://payments.amazon.com/checkout/2008-06-15/\">" .
	    "    <ClientRequestId>123457</ClientRequestId>" .
	    "    <Cart>" .
	    "    <Items>" .
	    "      <Item>" .
	    "         <SKU>CALVIN-HOBBES</SKU>" .
	    "         <MerchantId>" . $merchantID . "</MerchantId>" .
	    "         <Title>The Complete Calvin and Hobbes from PHP Sample Code XML</Title>" .
	    "         <Description>By Bill Watterson From PHP Sample Code XML</Description>" .
	    "         <Price>" .
	    "            <Amount>2.50</Amount>" .
	    "            <CurrencyCode>INR</CurrencyCode>" .
	    "         </Price>" .
	    "         <Quantity>1</Quantity>" .
	    "         <Weight>" .
	    "            <Amount>8.5</Amount>" .
	    "            <Unit>kg</Unit>" .
	    "         </Weight>" .
	    "         <Category>Books</Category>" .
	    "      </Item>" .
	    "    </Items>" .
	    "    </Cart>" .
	    "</Order>";
		*/
    }
}
