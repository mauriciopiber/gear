#!/bin/bash
php ./../../public/index.php gear project deploy development


php ./../../public/index.php gear module delete Power
php ./../../public/index.php gear module create Power


#controller/action alone

php ./../../public/index.php gear page create Power --controllerPage=MyController --actionPage=MyAction --routePage=my-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=MySecondController --actionPage=MySecondAction --routePage=my-second-action --rolePage=guest --invokablePage="%s\Controller\MySecond"
php ./../../public/index.php gear page create Power --controllerPage=MyController --actionPage=MergeAction --routePage=merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=MyController --actionPage=TwoMergeAction --routePage=two-merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=NameOneController --actionPage=MergeAction --routePage=merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=NameOneController --actionPage=TwoMergeAction --routePage=two-merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=NameOneController --actionPage=MergeAction --routePage=merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=MyController --actionPage=TwoMergeAction --routePage=two-merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=MyController --actionPage=MergeAction --routePage=merge-action --rolePage=guest --invokablePage="%s\Controller\My"
php ./../../public/index.php gear page create Power --controllerPage=MyController --actionPage=TwoMergeAction --routePage=two-merge-action --rolePage=guest --invokablePage="%s\Controller\My"


#src alone

php ./../../public/index.php gear src create Power --type="Controller\Plugin" --name="MyControllerPlugin"
php ./../../public/index.php gear src create Power --type="Controller\Plugin" --name="MyTwoControllerPlugin"
php ./../../public/index.php gear src create Power --type="Controller\Plugin" --name="MyThreeControllerPlugin"
php ./../../public/index.php gear src create Power --type="Entity" --name="MyEntity"
php ./../../public/index.php gear src create Power --type="Entity" --name="MyTwoEntity"
php ./../../public/index.php gear src create Power --type="Form" --name="MyForm"
php ./../../public/index.php gear src create Power --type="Form" --name="MyTwoForm"
php ./../../public/index.php gear src create Power --type="Filter" --name="MyFilter"
php ./../../public/index.php gear src create Power --type="Filter" --name="MyTwoFilter"
php ./../../public/index.php gear src create Power --type="Factory" --name="MyFactory"
php ./../../public/index.php gear src create Power --type="Factory" --name="MyTwoFactory"
php ./../../public/index.php gear src create Power --type="ValueObject" --name="MyValueObject"
php ./../../public/index.php gear src create Power --type="ValueObject" --name="MyTwoValueObject"
php ./../../public/index.php gear src create Power --type="Repository" --name="MyRepository"
php ./../../public/index.php gear src create Power --type="Repository" --name="MyTwoRepository"
php ./../../public/index.php gear src create Power --type="Service" --name="MyService"
php ./../../public/index.php gear src create Power --type="Service" --name="MyTwoService"
php ./../../public/index.php gear src create Power --type="Service" --name="DependencyService" --dependency="Repository\MyTwoRepository"
php ./../../public/index.php gear src create Power --type="Service" --name="DependencyTwoService" --dependency="Repository\MyTwoRepository,Service\DependencyService"


#db
php ./../../public/index.php gear db create Power --table="Module"
php ./../../public/index.php gear db create Power --table="Controller"
php ./../../public/index.php gear db create Power --table="Action"
php ./../../public/index.php gear db create Power --table="Role"
php ./../../public/index.php gear db create Power --table="UserRoleLinker"