<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2019
 * Time: 0:11
 */

namespace App\Strategies\OauthGrantType;

use App\Enums\OauthGrantTypesEnum;
use App\Strategies\Interfaces\OauthGrantTypeStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use App\Strategies\OauthGrantType\Strategies\ClientCredentialsGrantTypeStrategy;
use App\Strategies\OauthGrantType\Strategies\NullGrantTypeStrategy;
use App\Strategies\OauthGrantType\Strategies\RefreshGrantTypeStrategy;
use Illuminate\Support\Collection;

class OauthGrantTypeStrategy implements StrategyInterface
{
    /**
     * @var Collection
     */
    private $strategies;

    public function __construct()
    {
        $this->loadStrategies();
    }

    public function loadStrategies()
    {
        $this->strategies = collect();
        $this->strategies->put(OauthGrantTypesEnum::CLIENT_CREDENTIALS, new ClientCredentialsGrantTypeStrategy());
        $this->strategies->put(OauthGrantTypesEnum::REFRESH, new RefreshGrantTypeStrategy());
    }

    /**
     * @param $type
     * @return OauthGrantTypeStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullGrantTypeStrategy();
        }

        return $this->strategies->get($type);
    }
}
