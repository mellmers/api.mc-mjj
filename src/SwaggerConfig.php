<?php

/**
 * @SWG\Swagger(
 *     basePath="/web/index.php",
 *     host="127.0.0.1",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Project-X",
 *         @SWG\Contact(name="project X team", url="http://developer.projectX.com"),
 *         @SWG\License(name="Creative Commons 4.0 International", url="http://creativecommons.org/licenses/by/4.0/")
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="User",
 *         @SWG\Property(property="id", type="string"),
 *         @SWG\Property(property="email", type="string"),
 *         @SWG\Property(property="username", type="string"),
 *         @SWG\Property(property="password",  type="string"),
 *         @SWG\Property(property="trusted", type="boolean"),
 *         @SWG\Property(property="icon",  type="string"),
 *         @SWG\Property(property="coins", type="integer"),
 *         @SWG\Property(property="createdAt", type="integer")
 *     ),
 *     @SWG\Definition(
 *         definition="Bet",
 *         @SWG\Property(property="userId", type="string"),
 *         @SWG\Property(property="lobbyId", type="string"),
 *         @SWG\Property(property="amount",  type="integer"),
 *         @SWG\Property(property="team", type="integer")
 *     ),
 *     @SWG\Definition(
 *         definition="Game",
 *         @SWG\Property(property="id", type="string"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="type", type="string"),
 *         @SWG\Property(property="icon",  type="string"),
 *         @SWG\Property(property="rules", type="string"),
 *         @SWG\Property(property="genre",  type="string"),
 *         @SWG\Property(property="timelimit", type="integer")
 *     ),
 *     @SWG\Definition(
 *         definition="GameAccount",
 *         @SWG\Property(property="userId", type="string"),
 *         @SWG\Property(property="userIdentifier", type="string"),
 *         @SWG\Property(property="gameaccountTypeId", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="GameAccountType",
 *         @SWG\Property(property="id", type="string"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="icon", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="Lobby",
 *         @SWG\Property(property="id", type="string"),
 *         @SWG\Property(property="ownerId", type="string"),
 *         @SWG\Property(property="gameId", type="string"),
 *         @SWG\Property(property="winnerTeam",  type="integer"),
 *         @SWG\Property(property="createdAt", type="integer"),
 *         @SWG\Property(property="starttime",  type="integer"),
 *         @SWG\Property(property="endtime", type="integer"),
 *         @SWG\Property(property="users", type="array")
 *     )
 * )
 *
 *
 * @SWG\Tag(name="bet", description="All about bets")
 * @SWG\Tag(name="game", description="All about games")
 * @SWG\Tag(name="gameAccount", description="All about gameAccounts")
 * @SWG\Tag(name="gameAccountType", description="All about gameAccountTypes")
 * @SWG\Tag(name="lobby", description="All about lobbies")
 * @SWG\Tag(name="user", description="All about users")
 *
 *
 * @SWG\Parameter(name="gameId", in="path", type="string", description="a Game id used to find the game object")
 * @SWG\Parameter(name="lobbyId", in="path", type="string", description="a Lobby id used to find the game Lobby")
 * @SWG\Parameter(name="userId", in="path", type="string", description="a user id used to find the game user")
 * @SWG\Parameter(name="gameAccountId", in="path", type="string", description="a gameAccount Id used to find the gameAccount object")
 * @SWG\Parameter(name="gameAccountTypeId", in="path", type="string", description="a gameAccountType Id used to find the gameAccountType object")
 * @SWG\Parameter(name="gameAccount", in="path", type="Gameaccount", description="a gameAccount used to find the gameAccount object")
 * @SWG\Parameter(name="betId", in="path", type="string", description="a bet id used to find the bet object")
 *
 * @SWG\Parameter(name="type", in="path", type="string", description="a type id used to find the right object")
 * @SWG\Parameter(name="genre", in="path", type="string", description="a genre string used to find the game object")
 */