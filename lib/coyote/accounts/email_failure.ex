defmodule Coyote.Accounts.EmailFailure do
  use Ecto.Schema
  import Ecto.Changeset

  schema "email_failures" do
    field :error, :string

    timestamps()
  end

  @doc false
  def changeset(email_failure, attrs) do
    email_failure
    |> cast(attrs, [:error])
    |> validate_required([:error])
  end
end
