<?php
// This file was auto-generated from sdk-root/src/data/directconnect/2012-10-25/api-2.json
return [ 'metadata' => [ 'apiVersion' => '2012-10-25', 'endpointPrefix' => 'directconnect', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'AWS Direct Connect', 'signatureVersion' => 'v4', 'targetPrefix' => 'OvertureService', ], 'operations' => [ 'AllocateConnectionOnInterconnect' => [ 'name' => 'AllocateConnectionOnInterconnect', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AllocateConnectionOnInterconnectRequest', ], 'output' => [ 'shape' => 'Connection', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'AllocatePrivateVirtualInterface' => [ 'name' => 'AllocatePrivateVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AllocatePrivateVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'VirtualInterface', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'AllocatePublicVirtualInterface' => [ 'name' => 'AllocatePublicVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AllocatePublicVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'VirtualInterface', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'ConfirmConnection' => [ 'name' => 'ConfirmConnection', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ConfirmConnectionRequest', ], 'output' => [ 'shape' => 'ConfirmConnectionResponse', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'ConfirmPrivateVirtualInterface' => [ 'name' => 'ConfirmPrivateVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ConfirmPrivateVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'ConfirmPrivateVirtualInterfaceResponse', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'ConfirmPublicVirtualInterface' => [ 'name' => 'ConfirmPublicVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ConfirmPublicVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'ConfirmPublicVirtualInterfaceResponse', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'CreateConnection' => [ 'name' => 'CreateConnection', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateConnectionRequest', ], 'output' => [ 'shape' => 'Connection', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'CreateInterconnect' => [ 'name' => 'CreateInterconnect', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateInterconnectRequest', ], 'output' => [ 'shape' => 'Interconnect', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'CreatePrivateVirtualInterface' => [ 'name' => 'CreatePrivateVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreatePrivateVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'VirtualInterface', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'CreatePublicVirtualInterface' => [ 'name' => 'CreatePublicVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreatePublicVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'VirtualInterface', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DeleteConnection' => [ 'name' => 'DeleteConnection', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteConnectionRequest', ], 'output' => [ 'shape' => 'Connection', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DeleteInterconnect' => [ 'name' => 'DeleteInterconnect', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteInterconnectRequest', ], 'output' => [ 'shape' => 'DeleteInterconnectResponse', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DeleteVirtualInterface' => [ 'name' => 'DeleteVirtualInterface', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteVirtualInterfaceRequest', ], 'output' => [ 'shape' => 'DeleteVirtualInterfaceResponse', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DescribeConnections' => [ 'name' => 'DescribeConnections', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeConnectionsRequest', ], 'output' => [ 'shape' => 'Connections', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DescribeConnectionsOnInterconnect' => [ 'name' => 'DescribeConnectionsOnInterconnect', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeConnectionsOnInterconnectRequest', ], 'output' => [ 'shape' => 'Connections', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DescribeInterconnects' => [ 'name' => 'DescribeInterconnects', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeInterconnectsRequest', ], 'output' => [ 'shape' => 'Interconnects', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DescribeLocations' => [ 'name' => 'DescribeLocations', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'output' => [ 'shape' => 'Locations', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DescribeVirtualGateways' => [ 'name' => 'DescribeVirtualGateways', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'output' => [ 'shape' => 'VirtualGateways', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], 'DescribeVirtualInterfaces' => [ 'name' => 'DescribeVirtualInterfaces', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeVirtualInterfacesRequest', ], 'output' => [ 'shape' => 'VirtualInterfaces', ], 'errors' => [ [ 'shape' => 'DirectConnectServerException', 'exception' => true, ], [ 'shape' => 'DirectConnectClientException', 'exception' => true, ], ], ], ], 'shapes' => [ 'ASN' => [ 'type' => 'integer', ], 'AllocateConnectionOnInterconnectRequest' => [ 'type' => 'structure', 'required' => [ 'bandwidth', 'connectionName', 'ownerAccount', 'interconnectId', 'vlan', ], 'members' => [ 'bandwidth' => [ 'shape' => 'Bandwidth', ], 'connectionName' => [ 'shape' => 'ConnectionName', ], 'ownerAccount' => [ 'shape' => 'OwnerAccount', ], 'interconnectId' => [ 'shape' => 'InterconnectId', ], 'vlan' => [ 'shape' => 'VLAN', ], ], ], 'AllocatePrivateVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'connectionId', 'ownerAccount', 'newPrivateVirtualInterfaceAllocation', ], 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], 'ownerAccount' => [ 'shape' => 'OwnerAccount', ], 'newPrivateVirtualInterfaceAllocation' => [ 'shape' => 'NewPrivateVirtualInterfaceAllocation', ], ], ], 'AllocatePublicVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'connectionId', 'ownerAccount', 'newPublicVirtualInterfaceAllocation', ], 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], 'ownerAccount' => [ 'shape' => 'OwnerAccount', ], 'newPublicVirtualInterfaceAllocation' => [ 'shape' => 'NewPublicVirtualInterfaceAllocation', ], ], ], 'AmazonAddress' => [ 'type' => 'string', ], 'BGPAuthKey' => [ 'type' => 'string', ], 'Bandwidth' => [ 'type' => 'string', ], 'CIDR' => [ 'type' => 'string', ], 'ConfirmConnectionRequest' => [ 'type' => 'structure', 'required' => [ 'connectionId', ], 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], ], ], 'ConfirmConnectionResponse' => [ 'type' => 'structure', 'members' => [ 'connectionState' => [ 'shape' => 'ConnectionState', ], ], ], 'ConfirmPrivateVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceId', 'virtualGatewayId', ], 'members' => [ 'virtualInterfaceId' => [ 'shape' => 'VirtualInterfaceId', ], 'virtualGatewayId' => [ 'shape' => 'VirtualGatewayId', ], ], ], 'ConfirmPrivateVirtualInterfaceResponse' => [ 'type' => 'structure', 'members' => [ 'virtualInterfaceState' => [ 'shape' => 'VirtualInterfaceState', ], ], ], 'ConfirmPublicVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceId', ], 'members' => [ 'virtualInterfaceId' => [ 'shape' => 'VirtualInterfaceId', ], ], ], 'ConfirmPublicVirtualInterfaceResponse' => [ 'type' => 'structure', 'members' => [ 'virtualInterfaceState' => [ 'shape' => 'VirtualInterfaceState', ], ], ], 'Connection' => [ 'type' => 'structure', 'members' => [ 'ownerAccount' => [ 'shape' => 'OwnerAccount', ], 'connectionId' => [ 'shape' => 'ConnectionId', ], 'connectionName' => [ 'shape' => 'ConnectionName', ], 'connectionState' => [ 'shape' => 'ConnectionState', ], 'region' => [ 'shape' => 'Region', ], 'location' => [ 'shape' => 'LocationCode', ], 'bandwidth' => [ 'shape' => 'Bandwidth', ], 'vlan' => [ 'shape' => 'VLAN', ], 'partnerName' => [ 'shape' => 'PartnerName', ], ], ], 'ConnectionId' => [ 'type' => 'string', ], 'ConnectionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Connection', ], ], 'ConnectionName' => [ 'type' => 'string', ], 'ConnectionState' => [ 'type' => 'string', 'enum' => [ 'ordering', 'requested', 'pending', 'available', 'down', 'deleting', 'deleted', 'rejected', ], ], 'Connections' => [ 'type' => 'structure', 'members' => [ 'connections' => [ 'shape' => 'ConnectionList', ], ], ], 'CreateConnectionRequest' => [ 'type' => 'structure', 'required' => [ 'location', 'bandwidth', 'connectionName', ], 'members' => [ 'location' => [ 'shape' => 'LocationCode', ], 'bandwidth' => [ 'shape' => 'Bandwidth', ], 'connectionName' => [ 'shape' => 'ConnectionName', ], ], ], 'CreateInterconnectRequest' => [ 'type' => 'structure', 'required' => [ 'interconnectName', 'bandwidth', 'location', ], 'members' => [ 'interconnectName' => [ 'shape' => 'InterconnectName', ], 'bandwidth' => [ 'shape' => 'Bandwidth', ], 'location' => [ 'shape' => 'LocationCode', ], ], ], 'CreatePrivateVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'connectionId', 'newPrivateVirtualInterface', ], 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], 'newPrivateVirtualInterface' => [ 'shape' => 'NewPrivateVirtualInterface', ], ], ], 'CreatePublicVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'connectionId', 'newPublicVirtualInterface', ], 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], 'newPublicVirtualInterface' => [ 'shape' => 'NewPublicVirtualInterface', ], ], ], 'CustomerAddress' => [ 'type' => 'string', ], 'DeleteConnectionRequest' => [ 'type' => 'structure', 'required' => [ 'connectionId', ], 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], ], ], 'DeleteInterconnectRequest' => [ 'type' => 'structure', 'required' => [ 'interconnectId', ], 'members' => [ 'interconnectId' => [ 'shape' => 'InterconnectId', ], ], ], 'DeleteInterconnectResponse' => [ 'type' => 'structure', 'members' => [ 'interconnectState' => [ 'shape' => 'InterconnectState', ], ], ], 'DeleteVirtualInterfaceRequest' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceId', ], 'members' => [ 'virtualInterfaceId' => [ 'shape' => 'VirtualInterfaceId', ], ], ], 'DeleteVirtualInterfaceResponse' => [ 'type' => 'structure', 'members' => [ 'virtualInterfaceState' => [ 'shape' => 'VirtualInterfaceState', ], ], ], 'DescribeConnectionsOnInterconnectRequest' => [ 'type' => 'structure', 'required' => [ 'interconnectId', ], 'members' => [ 'interconnectId' => [ 'shape' => 'InterconnectId', ], ], ], 'DescribeConnectionsRequest' => [ 'type' => 'structure', 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], ], ], 'DescribeInterconnectsRequest' => [ 'type' => 'structure', 'members' => [ 'interconnectId' => [ 'shape' => 'InterconnectId', ], ], ], 'DescribeVirtualInterfacesRequest' => [ 'type' => 'structure', 'members' => [ 'connectionId' => [ 'shape' => 'ConnectionId', ], 'virtualInterfaceId' => [ 'shape' => 'VirtualInterfaceId', ], ], ], 'DirectConnectClientException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'DirectConnectServerException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'ErrorMessage', ], ], 'exception' => true, ], 'ErrorMessage' => [ 'type' => 'string', ], 'Interconnect' => [ 'type' => 'structure', 'members' => [ 'interconnectId' => [ 'shape' => 'InterconnectId', ], 'interconnectName' => [ 'shape' => 'InterconnectName', ], 'interconnectState' => [ 'shape' => 'InterconnectState', ], 'region' => [ 'shape' => 'Region', ], 'location' => [ 'shape' => 'LocationCode', ], 'bandwidth' => [ 'shape' => 'Bandwidth', ], ], ], 'InterconnectId' => [ 'type' => 'string', ], 'InterconnectList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Interconnect', ], ], 'InterconnectName' => [ 'type' => 'string', ], 'InterconnectState' => [ 'type' => 'string', 'enum' => [ 'requested', 'pending', 'available', 'down', 'deleting', 'deleted', ], ], 'Interconnects' => [ 'type' => 'structure', 'members' => [ 'interconnects' => [ 'shape' => 'InterconnectList', ], ], ], 'Location' => [ 'type' => 'structure', 'members' => [ 'locationCode' => [ 'shape' => 'LocationCode', ], 'locationName' => [ 'shape' => 'LocationName', ], ], ], 'LocationCode' => [ 'type' => 'string', ], 'LocationList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Location', ], ], 'LocationName' => [ 'type' => 'string', ], 'Locations' => [ 'type' => 'structure', 'members' => [ 'locations' => [ 'shape' => 'LocationList', ], ], ], 'NewPrivateVirtualInterface' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceName', 'vlan', 'asn', 'virtualGatewayId', ], 'members' => [ 'virtualInterfaceName' => [ 'shape' => 'VirtualInterfaceName', ], 'vlan' => [ 'shape' => 'VLAN', ], 'asn' => [ 'shape' => 'ASN', ], 'authKey' => [ 'shape' => 'BGPAuthKey', ], 'amazonAddress' => [ 'shape' => 'AmazonAddress', ], 'customerAddress' => [ 'shape' => 'CustomerAddress', ], 'virtualGatewayId' => [ 'shape' => 'VirtualGatewayId', ], ], ], 'NewPrivateVirtualInterfaceAllocation' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceName', 'vlan', 'asn', ], 'members' => [ 'virtualInterfaceName' => [ 'shape' => 'VirtualInterfaceName', ], 'vlan' => [ 'shape' => 'VLAN', ], 'asn' => [ 'shape' => 'ASN', ], 'authKey' => [ 'shape' => 'BGPAuthKey', ], 'amazonAddress' => [ 'shape' => 'AmazonAddress', ], 'customerAddress' => [ 'shape' => 'CustomerAddress', ], ], ], 'NewPublicVirtualInterface' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceName', 'vlan', 'asn', 'amazonAddress', 'customerAddress', 'routeFilterPrefixes', ], 'members' => [ 'virtualInterfaceName' => [ 'shape' => 'VirtualInterfaceName', ], 'vlan' => [ 'shape' => 'VLAN', ], 'asn' => [ 'shape' => 'ASN', ], 'authKey' => [ 'shape' => 'BGPAuthKey', ], 'amazonAddress' => [ 'shape' => 'AmazonAddress', ], 'customerAddress' => [ 'shape' => 'CustomerAddress', ], 'routeFilterPrefixes' => [ 'shape' => 'RouteFilterPrefixList', ], ], ], 'NewPublicVirtualInterfaceAllocation' => [ 'type' => 'structure', 'required' => [ 'virtualInterfaceName', 'vlan', 'asn', 'amazonAddress', 'customerAddress', 'routeFilterPrefixes', ], 'members' => [ 'virtualInterfaceName' => [ 'shape' => 'VirtualInterfaceName', ], 'vlan' => [ 'shape' => 'VLAN', ], 'asn' => [ 'shape' => 'ASN', ], 'authKey' => [ 'shape' => 'BGPAuthKey', ], 'amazonAddress' => [ 'shape' => 'AmazonAddress', ], 'customerAddress' => [ 'shape' => 'CustomerAddress', ], 'routeFilterPrefixes' => [ 'shape' => 'RouteFilterPrefixList', ], ], ], 'OwnerAccount' => [ 'type' => 'string', ], 'PartnerName' => [ 'type' => 'string', ], 'Region' => [ 'type' => 'string', ], 'RouteFilterPrefix' => [ 'type' => 'structure', 'members' => [ 'cidr' => [ 'shape' => 'CIDR', ], ], ], 'RouteFilterPrefixList' => [ 'type' => 'list', 'member' => [ 'shape' => 'RouteFilterPrefix', ], ], 'RouterConfig' => [ 'type' => 'string', ], 'VLAN' => [ 'type' => 'integer', ], 'VirtualGateway' => [ 'type' => 'structure', 'members' => [ 'virtualGatewayId' => [ 'shape' => 'VirtualGatewayId', ], 'virtualGatewayState' => [ 'shape' => 'VirtualGatewayState', ], ], ], 'VirtualGatewayId' => [ 'type' => 'string', ], 'VirtualGatewayList' => [ 'type' => 'list', 'member' => [ 'shape' => 'VirtualGateway', ], ], 'VirtualGatewayState' => [ 'type' => 'string', ], 'VirtualGateways' => [ 'type' => 'structure', 'members' => [ 'virtualGateways' => [ 'shape' => 'VirtualGatewayList', ], ], ], 'VirtualInterface' => [ 'type' => 'structure', 'members' => [ 'ownerAccount' => [ 'shape' => 'OwnerAccount', ], 'virtualInterfaceId' => [ 'shape' => 'VirtualInterfaceId', ], 'location' => [ 'shape' => 'LocationCode', ], 'connectionId' => [ 'shape' => 'ConnectionId', ], 'virtualInterfaceType' => [ 'shape' => 'VirtualInterfaceType', ], 'virtualInterfaceName' => [ 'shape' => 'VirtualInterfaceName', ], 'vlan' => [ 'shape' => 'VLAN', ], 'asn' => [ 'shape' => 'ASN', ], 'authKey' => [ 'shape' => 'BGPAuthKey', ], 'amazonAddress' => [ 'shape' => 'AmazonAddress', ], 'customerAddress' => [ 'shape' => 'CustomerAddress', ], 'virtualInterfaceState' => [ 'shape' => 'VirtualInterfaceState', ], 'customerRouterConfig' => [ 'shape' => 'RouterConfig', ], 'virtualGatewayId' => [ 'shape' => 'VirtualGatewayId', ], 'routeFilterPrefixes' => [ 'shape' => 'RouteFilterPrefixList', ], ], ], 'VirtualInterfaceId' => [ 'type' => 'string', ], 'VirtualInterfaceList' => [ 'type' => 'list', 'member' => [ 'shape' => 'VirtualInterface', ], ], 'VirtualInterfaceName' => [ 'type' => 'string', ], 'VirtualInterfaceState' => [ 'type' => 'string', 'enum' => [ 'confirming', 'verifying', 'pending', 'available', 'deleting', 'deleted', 'rejected', ], ], 'VirtualInterfaceType' => [ 'type' => 'string', ], 'VirtualInterfaces' => [ 'type' => 'structure', 'members' => [ 'virtualInterfaces' => [ 'shape' => 'VirtualInterfaceList', ], ], ], ],];
