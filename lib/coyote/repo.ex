defmodule Coyote.Repo do
  use Ecto.Repo,
    otp_app: :coyote,
    adapter: Ecto.Adapters.Postgres
end
